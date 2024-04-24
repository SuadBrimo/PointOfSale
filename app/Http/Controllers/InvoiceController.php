<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Models\PointOfSale;
use Carbon\Carbon;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Requests\InvoiceRequest;

class InvoiceController extends Controller
{
    public function index(PointOfSale $pointOfSale): AnonymousResourceCollection
    {
        return InvoiceResource::collection($pointOfSale->invoices()->with(
            'invoiceProducts.productWarehouse.product')
            ->get()
        );
    }

    public function store(InvoiceRequest $request, PointOfSale $pointOfSale)
    {
        $validatedData = $request->validated();

        $totalPrice = $this->calculateTotalPrice($validatedData);

        // @todo generate sequential, unique number for invoice
        // @todo take user id from auth('api')->user()
        $invoice = Invoice::create([
            'invoice_number' => fake()->numberBetween(1, 1000),
            'point_of_sale_id' => $pointOfSale->id,
            'user_id' => 1,
            'invoice_date' => Carbon::now()->format('Y-m-d'),
            'total_price' => $totalPrice,
            'discount' => $validatedData['discount'],
            'tax' => $validatedData['tax'],
        ]);

        foreach ($validatedData['invoice_products'] as $productData) {
            $invoice->invoiceProducts()->create([
                'product_warehouse_id' => $productData['product_warehouse_id'],
                'quantity' => $productData['quantity'],
                'unit_price' => $productData['unit_price'],
                'total_price' => $productData['quantity'] * $productData['unit_price']
            ]);
        }

        $invoice->decreaseProductQuantities();

        return response()->json($invoice, 201);
    }

    public function update(InvoiceRequest $request, PointOfSale $pointOfSale, Invoice $invoice)
    {
        $validatedData = $request->validated();

        $totalPrice = $this->calculateTotalPrice($validatedData);

        // Update the invoice details
        $invoice->update([
            'discount' => $validatedData['discount'],
            'tax' => $validatedData['tax'],
            'total_price' => $totalPrice,
        ]);

        // Update the invoice products
        foreach ($validatedData['invoice_products'] as $productData) {
            $invoice->invoiceProducts()->updateOrCreate(
                ['id' => $productData['id']],
                [
                    'product_warehouse_id' => $productData['product_warehouse_id'],
                    'quantity' => $productData['quantity'],
                    'unit_price' => $productData['unit_price'],
                    'total_price' => $productData['quantity'] * $productData['unit_price']
                ]
            );
        }

        return response()->json($invoice, 200);
    }

    public function destroy(PointOfSale $pointOfSale, Invoice $invoice): \Illuminate\Http\JsonResponse
    {
        $invoice->invoiceProducts()->delete();
        $invoice->delete();

        return response()->json(['message' => 'Invoice and associated products deleted successfully'], 200);
    }

    public static function calculateTotalPrice(array $data): float
    {
        $invoiceProducts = $data['invoice_products'];
        $discount = $data['discount'];
        $tax = $data['tax'];
        $totalPrice = 0;

        foreach ($invoiceProducts as $productData) {
            $totalPrice += $productData['quantity'] * $productData['unit_price'];
        }

        // Apply discount logic based on discount type
        if (is_numeric($discount)) {
            // Fixed amount discount
            $totalPrice -= $discount;
        } else if (is_string($discount) && str_ends_with($discount, '%')) {
            // Percentage discount
            $percentage = (float)str_replace('%', '', $discount);
            $discountAmount = $totalPrice * ($percentage / 100);
            $totalPrice -= $discountAmount;
        }

        // Calculate and add tax
        $taxAmount = $totalPrice * ($tax / 100);
        $totalPrice += $taxAmount;

        return $totalPrice;
    }
}
