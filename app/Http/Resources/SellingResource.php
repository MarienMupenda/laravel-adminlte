<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'customer_id'=>$this->customer_id,
            'created_at'=>$this->created_at,
            'items'=>SellingDetailsResource::collection($this->sellingDetails),
            'currency'=>$this->currency->symbol,
            'payment_method'=>$this->payment_method,
            'payment'=>$this->payment(),
            'amount'=>$this->amount(),
            'state'=>$this->state,
            'paymentId'=>$this->paymentId,
            'note'=>$this->note,
        ];
    }
}
