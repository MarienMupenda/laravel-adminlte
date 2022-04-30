<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Helpers;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\PaymentRequest;
use DB;
use App\Jobs\SendEmailJob;
use App\Jobs\ApplyPaymentJob;
use App\Jobs\ReceivedPaymentJob;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Helpers::checkKey($request->ApiKey)) {
            return "Success";
        }

        abort(404);


        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PaymentRequest $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $action = ['debit', 'credit', 'verify'];
        $state = ['pending', 'processing', 'done', 'failed'];

        if (Helpers::checkKey($request->ApiKey)) {
            $payment = new Payment();
            $payment->method = $request->method;
            $payment->action = $action[0];
            $payment->customer_number = $request->customer_number;
            $payment->amount = $request->amount;
            $payment->currency = $request->currency;
            $payment->reference = Helpers::randString();
            $payment->company_id = $request->company_id??0;
            $payment->reference_name = $request->reference_name;
            $payment->reference_id = $request->reference_id;
            $payment->user_id = $request->user_id;
            $payment->email = $request->email;
            $payment->save();

            if ($payment) {

                $data = [
                    "merchant_id" => env('FRESH_PAY_MERCHANT_ID', null),
                    "merchant_secrete" => env('FRESH_PAY_MERCHANT_SECRET', null),
                    "amount" => $payment->amount,
                    "currency" => strtoupper($payment->currency),
                    "action" => $payment->action,
                    "customer_number" => $payment->customer_number,
                    "firstname" => env('FRESH_PAY_FIRSTNAME', null),
                    "lastname" => env('FRESH_PAY_LASTNAME', null),
                    "email" => env('FRESH_PAY_EMAIL', null),
                    "reference" => $payment->reference,
                    "method" => $payment->method,
                    "callback_url" => env('CALL_BACK_URL', null) . "/$payment->id",
                ];

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json'
                ])->post(env('FRESH_PAY_API_URL', null), $data);
                $responseData = json_decode($response, true);
                $comment = $responseData['Comment'];
                $status = $response->status();
                if ($response->ok()) {
                    return $this->processingPayment($payment->id, $state[1], $comment, $responseData['Transaction_id']);
                } else {
                    switch ($response->status()) {
                        case 400:
                            $this->updatePayment($payment->id, $state[3], 400, $comment);
                            return $this->errorResponse($payment, $comment, $status);
                            break;
                        case 401:
                            $this->updatePayment($payment->id, $state[3], 401, $comment);
                            return $this->errorResponse($payment, $comment, $status);
                            break;
                        case 402:
                            $this->updatePayment($payment->id, $state[3], 402, $comment);
                            return $this->errorResponse($payment, $comment, $status);
                            break;
                        case 404:
                            $this->updatePayment($payment->id, $state[3], 404, $comment);
                            return $this->errorResponse($payment, $comment, $status);
                            break;
                        case 405:
                            $this->updatePayment($payment->id, $state[3], 405, $comment);
                            return $this->errorResponse($payment, $comment, $status);
                            break;
                        case 406:
                            $this->updatePayment($payment->id, $state[3], 406, $comment);
                            return $this->errorResponse($payment, $comment, $status);
                            break;
                        case 407:
                            $this->updatePayment($payment->id, $state[3], 407, $comment);
                            return $this->errorResponse($payment, $comment, $status);
                            break;
                        case 408:
                            $this->updatePayment($payment->id, $state[3], 408, $comment);
                            return $this->errorResponse($payment, $comment, $status);

                            break;
                        case 409:
                            $this->updatePayment($payment->id, $state[3], 409, $comment);
                            return $this->errorResponse($payment, $comment, $status);
                            break;
                        default:
                            $this->updatePayment($payment->id, $state[3], $response->status(), $comment);
                            return $this->errorResponse($payment, $comment, $status);

                    }
                }
            }

            abort(502);
        }

        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Payment $payment)
    {

        if (Helpers::checkKey($request->ApiKey)) {
            return $payment;
        }

        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
        if (Helpers::checkKey($request->ApiKey)) {
            return "Success";
        }

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
        if (Helpers::checkKey($request->ApiKey)) {
            return "Success";
        }

        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        abort(405);
    }

    public function forbiden()
    {
        return response()->view("forbiden", ['message' => "Forbiden"], 403);
    }


    public function callBack($id)
    {
        $payment = Payment::where('id', $id)->first();
        if (!$payment == null) {
            switch ($payment->state) {

                case "failed":
                    return $this->errorResponse($payment, $payment->comment, 200);
                    break;
                case "done":
                    $data = [
                        'paymentId' => $payment->id,
                        'comment' => $payment->comment,
                        "state" => 'done',
                        'status' => 'Successful',
                        'transaction_id' => $payment->transaction_id,
                        'financial_institution_id' => $payment->financial_institution_id,
                        "amount" => $payment->amount,
                        "currency" => $payment->currency,
                        "action" => $payment->action,
                        "customer_number" => $payment->customer_number,
                        "reference" => $payment->reference,
                        "method" => $payment->method,
                    ];
                    return response()->json($data, 200);
                    break;
                default:
                    $data = [
                        "merchant_id" => env('FRESH_PAY_MERCHANT_ID', null),
                        "merchant_secrete" => env('FRESH_PAY_MERCHANT_SECRET', null),
                        "action" => 'verify',
                        "reference" => $payment->reference,
                    ];
                    $response = Http::withHeaders([
                        'Content-Type' => 'application/json'
                    ])->post(env('FRESH_PAY_API_URL', null), $data);

                    $responseData = json_decode($response, true);
                    $Financial_Institution_id = $responseData['Financial_Institution_id'];
                    $Trans_Status = $responseData['Trans_Status'];
                    $status = $response->status();
                    if ($response->ok()) {
                        if ($Trans_Status == "Successful") {
                            $setPayment = Payment::where('id', $payment->id)->update([
                                'state' => 'done',
                                'comment' => 'Transaction Received Successfully',
                                'financial_institution_id' => $Financial_Institution_id,
                                'payment_date' => now(),]);

                            dispatch(new ReceivedPaymentJob($payment->id));

                            $data = [
                                'paymentId' => $payment->id,
                                'comment' => $payment->comment,
                                "state" => 'done',
                                'status' => 'Successful',
                                'transaction_id' => $payment->transaction_id,
                                'financial_institution_id' => $Financial_Institution_id,
                                "amount" => $payment->amount,
                                "currency" => $payment->currency,
                                "action" => $payment->action,
                                "customer_number" => $payment->customer_number,
                                "reference" => $payment->reference,
                                "method" => $payment->method,
                            ];
                            return response()->json($data, 200);
                        }
                        $data = [
                            'paymentId' => $payment->id,
                            'comment' => $payment->comment,
                            "state" => $payment->state,
                            'status' => 'Submitted',
                            'transaction_id' => $payment->transaction_id,
                            'financial_institution_id' => $payment->financial_institution_id, "amount" => $payment->amount,
                            "currency" => $payment->currency,
                            "action" => $payment->action,
                            "customer_number" => $payment->customer_number,
                            "reference" => $payment->reference,
                            "method" => $payment->method,
                        ];
                        return response()->json($data, 200);
                    }


            }
        }
        abort(404);
    }

    private function updatePayment($paymentId, $state, $error_code, $comment)
    {
        $payment = Payment::where('id', $paymentId)
            ->update([
                'attempts' => DB::raw('attempts+1'),
                'state' => $state,
                'error_code' => $error_code,
                'comment' => $comment,
            ]);
    }

    private function errorResponse($payment, $comment, $code)
    {
        $data = [
            'comment' => $comment,
            "state" => $payment->state,
            "status" => 'Error',
            "amount" => $payment->amount,
            "currency" => $payment->currency,
            "action" => $payment->action,
            "customer_number" => $payment->customer_number,
            "reference" => $payment->reference,
            "method" => $payment->method,
        ];
        return response()->json($data, $code);
    }

    private function processingPayment($paymentId, $state, $res_comment, $transaction_id)
    {
        Payment::where('id', $paymentId)->update([
            'attempts' => DB::raw('attempts+1'),
            'state' => $state,
            'transaction_id' => $transaction_id,
            'comment' => "Payment in processing...",
        ]);
        $payment = Payment::where('id', $paymentId)->first();
        if (!$payment->email == null) {
            dispatch(new SendEmailJob(
                $payment->email,
                $payment->email,
                "Uzaraka paiement",
                [
                    'body' => "Vous venez de faire une demande de payment en ligne sur Uzaraka,veullez valider l'achat en entrant votre mot de passe ",
                ]
            ));
        }

        $data = [
            'paymentId' => $payment->id,
            'comment' => "Votre demande est encours de traitement, veuillez valider le payment en entrant votre code PIN",
            "state" => $state,
            'status' => 'Submitted',
            'transaction_id' => $transaction_id,
            'financial_institution_id' => $payment->financial_institution_id,
            "amount" => $payment->amount,
            "currency" => $payment->currency,
            "action" => $payment->action,
            "customer_number" => $payment->customer_number,
            "reference" => $payment->reference,
            "method" => $payment->method,
        ];
        return response()->json($data, 200);
    }
}
