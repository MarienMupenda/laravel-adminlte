<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellingDetailsResource extends JsonResource
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
            'item_id'=>$this->item_id,
            'item_name'=>$this->item->name,
            'image'=>$this->item->image_small(),
            'qty'=>$this->qty,
            'price'=>$this->selling_price,
        ];
    }
}
