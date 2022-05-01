<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'string|required|max:255',
            'image' => 'image|nullable|max:1999',
            'category_id' => 'numeric|required',
            'description' => 'string|nullable',
            'price' => 'numeric|nullable|min:1',
            'unit_id' => 'numeric|required',
            'status' => 'string|nullable|in:draft,published,unpublished',
        ];
    }
}
