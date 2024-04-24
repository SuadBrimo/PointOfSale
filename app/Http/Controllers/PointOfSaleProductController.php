<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\PointOfSale;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PointOfSaleProductController extends Controller
{
    public function index(PointOfSale $pointOfSale): AnonymousResourceCollection
    {
        return ProductResource::collection($pointOfSale->warehouse->products()->get());
    }
}
