<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CompanyResource extends JsonResource
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
            'logo' => $this->logo(),
            'description' => $this->description,
            'address' => $this->address,
            'rccm' => $this->rccm,
            'idnat' => $this->idnat,
            'state' => $this->state,
            'business' => $this->business->name ?? null,
            'currency' => $this->currency,
            'contact' => $this->contact,
        ];
    }
}
