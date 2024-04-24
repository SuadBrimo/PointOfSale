<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
            'invoice_date' => $this->invoice_date,
            'point_of_sale_id' => $this->point_of_sale_id,
            'user_id' => $this->user_id,
            'total_price' => $this->total_price,
            'discount' => $this->discount,
            'tax' => $this->tax,
            'invoice_products' => InvoiceProductResource::collection($this->invoiceProducts),
        ];
    }
}
