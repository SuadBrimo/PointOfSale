<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => [
                'required',
                Rule::unique('products')->ignore($this->id)->whereNull('deleted_at')
            ],
            'name' => ['required', 'string', 'max:191'],
            'description' => ['string'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'category_id' => ['exists:categories,id'],
            'unit_id' => ['exists:units,id'],
            'cost_price' => ['required', 'numeric'],
            'attributes' => ['array'],
            'attributes.*.id' => ['required', 'integer'],
            'attributes.*.value' => ['required', 'string'],
        ];
    }
}
