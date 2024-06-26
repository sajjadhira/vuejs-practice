<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/customers', function () {
    $customers = \App\Models\Customer::orderBy('id', 'desc')->get();
    return response()->json([
        'customers' => $customers
    ], 200);
});

Route::get('/products', function () {
    $items = \App\Models\Product::orderBy('id', 'asc')->get();
    return response()->json([
        'products' => $items
    ], 200);
});

Route::get('/invoices', [InvoiceController::class, 'index']);
Route::post('/invoices/store', [InvoiceController::class, 'store']);

Route::get('/invoices/show/{id}', [InvoiceController::class, 'show']);
Route::get('/invoices/item/remove/{id}', [InvoiceController::class, 'removeItem']);
Route::post('/invoices/update/{id}', [InvoiceController::class, 'update']);
Route::get('/invoices/delete/{id}', [InvoiceController::class, 'destroy']);

Route::get('/invoices/last', function () {
    $invoice = \App\Models\Invoice::orderBy('id', 'desc')->first();
    return response()->json([
        'invoice' => $invoice,
        'date' => date('Y-m-d'),
        'due_date' => date('Y-m-d', strtotime('+30 days')),
        'discount' => 0,
        'reference' => 'INV-' . date('Ymd') . '-' . ($invoice->id + 1),
        'terms' => 'Payment due in 30 days'
    ], 200);
});
// customers

Route::get('/customers', function () {
    $customers = \App\Models\Customer::orderBy('id', 'desc')->get();
    return response()->json([
        'customers' => $customers
    ], 200);
});

Route::post('/customers/store', function (Request $request) {
    $customer = \App\Models\Customer::create($request->all());
    return response()->json([
        'customer' => $customer
    ], 200);
});
