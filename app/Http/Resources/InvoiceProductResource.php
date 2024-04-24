<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceProductResource extends JsonResource
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
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
            'total_price' => $this->total_price,
            'product_attributes' => $this->productWarehouse->product_attributes,
            'product_id' => $this->productWarehouse->product_id,
            'code' => $this->productWarehouse->product->code,
            'name' => $this->productWarehouse->product->name,
            'description' => $this->productWarehouse->product->description,
            'category_id' => $this->productWarehouse->product->category_id,
            'unit_id' => $this->productWarehouse->product->unit_id,
            'cost_price' => $this->productWarehouse->product->cost_price,
        ];
    }
}
