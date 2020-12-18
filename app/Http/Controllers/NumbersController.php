<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetPrimesByRangeRequest;
use App\Http\Requests\IsPrimeRequest;
use App\Services\PrimeNumber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NumbersController extends Controller
{
    private PrimeNumber $primeNumber;

    /**
     * NumbersController constructor.
     * @param PrimeNumber $primeNumber
     */
    public function __construct(PrimeNumber $primeNumber)
    {
        $this->primeNumber = $primeNumber;
    }

    /**
     * @param IsPrimeRequest $request
     * @return JsonResponse
     */
    public function isPrime(IsPrimeRequest $request): JsonResponse
    {
        $response = $this->primeNumber->store($request->input('number'));

        return response()->json($response->getArray(), $response->getStatusCode());
    }

    /**
     * @param GetPrimesByRangeRequest $request
     * @return JsonResponse
     */
    public function getPrimesByRange(GetPrimesByRangeRequest $request): JsonResponse
    {
        $response = $this->primeNumber->getByRange($request->input('from'), $request->input('to'));

        return response()->json($response->getArray(), $response->getStatusCode());
    }
}
