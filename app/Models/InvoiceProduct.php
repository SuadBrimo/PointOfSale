<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceProduct extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'invoice_product';

    protected $fillable = [
        'invoice_id',
        'product_warehouse_id',
        'quantity',
        'unit_price',
        'total_price',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function productWarehouse(): BelongsTo
    {
        return $this->belongsTo(ProductWarehouse::class);
    }

    public function invoiceProducts()
    {
        return $this->hasMany(InvoiceProduct::class)->withTimestamps();
    }
}
