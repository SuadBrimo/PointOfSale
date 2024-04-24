<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'point_of_sale_id',
        'user_id',
        'total_price',
        'discount',
        'tax'
    ];

    public function pointOfSale(): BelongsTo
    {
        return $this->belongsTo(PointOfSale::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('product_warehouse_id', 'quantity', 'unit_price', 'total_price');

    }

    public function invoiceProducts(): HasMany
    {
        return $this->hasMany(InvoiceProduct::class);
    }

    public function decreaseProductQuantities()
    {
        foreach ($this->invoiceProducts as $invoiceProduct) {
            $productWarehouse = $invoiceProduct->productWarehouse;
            $productWarehouse->quantity -= $invoiceProduct->quantity;
            $productWarehouse->save();

            if ($productWarehouse->quantity <= $productWarehouse->product->min_stock_level) {
                // Trigger alert for low stock
                // You can implement your preferred notification method here
                // e.g., email, SMS, or push notification
            }
        }
    }
}
