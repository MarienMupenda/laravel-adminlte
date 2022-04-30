<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */


    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'barcode' => $this->barcode,
            'description' => $this->description,
            'selling_price' => $this->selling_price,
            'state' => $this->state(),
            'image' => $this->image(),
            'image_small' => $this->thumbnail(),
            'category' => $this->category,
            'currency' => $this->currency,
            'company' => $this->company,
            'visits' =>$this->visits(),
        ];


    }
}
