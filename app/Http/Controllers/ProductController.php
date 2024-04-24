<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\PointOfSale;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function store(ProductRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $product = Product::create($validatedData);

        foreach ($validatedData['attributes'] as $attribute) {
            $product->attributes()->attach($attribute['id'], ['value' => $attribute['value']]);
        }

        $this->storeProductImage($request, $product);

        return response()->json($product, 201);
    }

    public function update(ProductRequest $request, PointOfSale $pointOfSale, Product $product): JsonResponse
    {
        $validatedData = $request->validated();
        $product->update([
            'code' => $validatedData['code'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'],
            'unit_id' => $validatedData['unit_id'],
            'cost_price' => $validatedData['cost_price'],
        ]);

        $this->storeProductImage($request, $product);

        if ($validatedData['attributes'] ?? []) {
            $product->attributes()->sync($validatedData['attributes']);
        }

        return response()->json($product, 200);
    }

    public function destroy(PointOfSale $pointOfSale, Product $product): JsonResponse
    {
        $product->load('image');

        if ($product->image) {
            Storage::delete('public/images/products/' . $product->image->name);
        }
        $product->attributes()->detach();
        $product->delete();

        return response()->json(['message' => 'Product and associated attributes deleted successfully'], 200);
    }

    private function storeProductImage($request, $product)
    {
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete('public/images/products/' . $product->image);
            }

            $image = $request->file('image');
            $originalFilename = $image->getClientOriginalName();
            $imageName = time() . '_' . $originalFilename; // Add a timestamp for uniqueness
            $request->image->storeAs('public/images/products', $imageName);
            $product->image()->create(['name' => $imageName]);
        }
    }
}
