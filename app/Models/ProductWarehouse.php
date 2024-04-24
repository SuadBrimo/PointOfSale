<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductWarehouse extends Model
{
    use HasFactory;

    protected $table = 'product_warehouse';

    protected $fillable = [
        'warehouse_id',
        'product_id',
        'product_attributes',
        'min_stock_level',
        'quantity',
        'unit_price',
        'receive_date',
    ];

    protected $casts = [
        'product_attributes' => 'array',
    ];

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function invoiceProducts(): HasMany
    {
        return $this->hasMany(InvoiceProduct::class);
    }
}
