<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'string|nullable|max:255',
            'image' => 'image|nullable|max:1999',
            'image_url' => 'url|nullable',
            'category_id' => 'numeric|nullable',
            'description' => 'string|nullable',
            'price' => 'numeric|nullable|min:1',
            'currency_id' => 'numeric|nullable',
            'unit_id' => 'numeric|nullable',
            'status' => 'string|nullable|in:draft,published,unpublished',
        ];
    }
}
