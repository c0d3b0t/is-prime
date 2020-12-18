<?php

use App\Http\Controllers\NumbersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('numbers')->group(function() {
    Route::post('/is-prime/', [NumbersController::class, 'isPrime'])->name('numbers.is_prime');
    Route::get('/prime-range/', [NumbersController::class, 'getPrimesByRange'])->name('numbers.primes_by_range');
    Route::get('/all-range/', [NumbersController::class, 'getAllByRange'])->name('numbers.primes_by_range');
});
