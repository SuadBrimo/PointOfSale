<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'category_name' => $this->category->name,
            'unit_id' => $this->unit_id,
            'unit_name' => $this->unit->name,
            'cost_price' => $this->cost_price,
            'warehouse_id' => $this->pivot->warehouse_id,
            'quantity' => $this->pivot->quantity,
            'receive_date' => $this->pivot->receive_date,
            'attributes' => json_decode($this->pivot->product_attributes)
        ];
    }
}
