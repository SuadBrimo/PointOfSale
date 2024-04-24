<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'discount' => ['nullable', 'string'],
            'tax' => ['nullable', 'numeric'],
            'invoice_products' => ['required', 'array',],
            'invoice_products.*.id' => ['present'],
            'invoice_products.*.product_warehouse_id' => ['required', 'exists:product_warehouse,id',],
            'invoice_products.*.quantity' => ['required', 'numeric', 'min:1',],
            'invoice_products.*.unit_price' => ['required', 'numeric', 'min:0',],
        ];
    }
}
