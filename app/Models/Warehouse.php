<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('product_attributes', 'min_stock_level', 'quantity', 'unit_price', 'receive_date')
            ->where('quantity', '>', 0)
            ->orderBy('receive_date', 'asc');

    }
}
