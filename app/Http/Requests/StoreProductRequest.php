<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|required|unique:products,name,NULL,id,company_id,' . Auth::user()->company_id,
            'image' => 'image|nullable|max:1999',
            'category_id' => 'numeric|required',
            'description' => 'string|nullable',
            'barcode' => 'numeric|nullable|unique:products,barcode,NULL,id,company_id,' . Auth::user()->company_id,
            'initial_price' => 'numeric|nullable|min:1',
            'selling_price' => 'numeric|required|min:1',
            'unit_id' => 'numeric|required',
            //  'quantity' => 'numeric|required|min:1',
            'status' => 'string|nullable|in:draft,published,unpublished',
        ];
    }
}
