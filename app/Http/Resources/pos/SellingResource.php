<?php

namespace App\Http\Resources\pos;

use Illuminate\Http\Resources\Json\JsonResource;

class SellingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer' => $this->customer,
            'seller' => $this->user->name ?? "",
            'company_id' => $this->company_id,
            'datetime' => $this->created_at,
            'reference' => $this->reference,
            'products' => SellingDetailsResource::collection($this->sellingDetails),
            'currency' => $this->currency->symbol,
        ];
    }
}