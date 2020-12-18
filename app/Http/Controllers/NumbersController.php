<?php

namespace App\Http\Controllers;

use App\Services\PrimeNumber;
use Illuminate\Http\JsonResponse;
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function isPrime(Request $request): JsonResponse
    {
        $response = $this->service->handlePrimeResponse($request->input('number'));

        return response()->json($response->getArray(), $response->getStatusCode());
    }
}
