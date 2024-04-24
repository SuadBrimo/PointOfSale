<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['code', 'name', 'description', 'category_id', 'unit_id', 'cost_price'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function (Product $product) {
            $product->image()->delete();
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class)->orderBy('attribute_order');
    }

    public function warehouses(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class);
    }

    public function image()
    {
        //@todo convert this relation to hasMany
        return $this->hasOne(Image::class);
    }
}
