<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'attribute_order'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
