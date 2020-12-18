<?php

namespace App\Http\Controllers;

use App\Services\PrimeNumber;
use Illuminate\Http\Request;

class NumbersController extends Controller
{
    private PrimeNumber $service;

    /**
     * NumbersController constructor.
     * @param PrimeNumber $primeNumber
     */
    public function __construct(PrimeNumber $primeNumber)
    {
        $this->service = $primeNumber;
    }

    public function isPrime(Request $request)
    {
        $response = $this->service->handlePrime($request->input('number'));

        return response()->json($response->getArray(), $response->getStatusCode());
    }
}
