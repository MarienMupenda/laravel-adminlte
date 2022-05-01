<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->item->slug,
            'description' => $this->description,
            'price' => $this->item->price,
            'category' => $this->item->category->name ?? null,
            'currency' => $this->item->currency->code ?? null,
            'stock' => $this->item->quantity,
            'image' => $this->item->image,
            'unit' => $this->item->unit->name,
            'status' => $this->item->status,
            'created_at' => $this->created_at,
        ];
    }
}
