<?php

namespace App\Models;

use App\DataTables\SellingTable;
use App\Http\Controllers\Api\v1\SellingController;
use App\Traits\HasLaTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Http;

class Selling extends Model
{


    use softDeletes;

    //protected $latable = SellingTable::class;


    public const STATE_PAID = 'paid';
    public const STATE_PENDING = 'pending';
    public const STATE_CANCELLED = 'cancelled';
    public const METHOD_CASH = 'cash';
    public const PAY_API_VERIFY = 'https://api.pay.uzaraka.com/v1/payments/';

    protected $fillable = [
        "company_id",
        "currency_id",
        "user_id",
        "customer",
        "state",
        "reference",
    ];


    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function payment()
    {
        if ($this->payment_method != self::METHOD_CASH) {

            $response = Http::withHeaders(['Content-Type' => 'application/json'])->get(self::PAY_API_VERIFY . $this->paymentId, [
                "ApiKey" => SellingController::PAY_API_KEY
            ]);

            $responseData = json_decode($response);

            if ($response->ok() and !empty($responseData)) {
                if ($responseData->state == 'done') {
                    $this->state = self::STATE_PAID;
                }
                if ($responseData->state == 'failed') {
                    $this->state = self::STATE_CANCELLED;
                }
                $this->update();
                return [
                    'id' => $responseData->id,
                    'state' => $responseData->state,
                    'comment' => $responseData->comment,
                    //'method'=>$responseData->method,
                    //'currency'=>$responseData->currency,
                    'transaction_id' => $responseData->financial_institution_id,
                ];
            }
        }
    }

    public function status()
    {
        return $this->state;
    }


    public function sellingDetails()
    {
        return $this->hasMany(SellingDetail::class);
    }

    public function makeInvoice()
    {
        return $this->created_at->format('ym') . '' . $this->id;
    }

    public function price()
    {

        return number_format($this->amount(), 0, ',', '.');
    }

    public function amount()
    {
        $total = 0;
        $details = $this->sellingDetails;
        foreach ($details as $detail) {
            //$total += $detail->selling_price * $detail->qty;
            $total += $detail->amount();
        }
        return $total;
    }

    public function initial_price()
    {
        $total = 0;
        $details = $this->sellingDetails;
        foreach ($details as $detail) {
            $total += $detail->initial_price * $detail->qty;
        }
        return $total;
    }
}