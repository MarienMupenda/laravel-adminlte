<?php

namespace App\Http\Resources\pos;

use Illuminate\Http\Resources\Json\JsonResource;

class SellingDetailsResource extends JsonResource
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
            'name' => $this->item->name ?? "Item",
            'qty' => $this->qty,
            'selling_price' => $this->selling_price,
        ];
    }
}