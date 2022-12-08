<?php

use App\Http\Controllers\Api\BondController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'bond'
], function () {
    Route::get('/{id}/payouts', [BondController::class, 'bondInterestPaymentDates']);
    Route::post('/{id}/order', [BondController::class, 'creatingBondPurchaseOrder']);
    Route::get('/order/{order_id}', [BondController::class, 'bondOrderInterestPayments']);
});

