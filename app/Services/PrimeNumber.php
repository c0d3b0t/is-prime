<?php

namespace App\Services;

use App\Models\RequestedNumber;
use App\Repositories\RequestedNumbersRepository;

class PrimeNumber
{
    /**
     * @var RequestedNumbersRepository
     */
    private RequestedNumbersRepository $numbersRepo;

    /**
     * @var HttpResponse
     */
    private HttpResponse $httpResponse;

    /**
     * @var ResponseMessage
     */
    private ResponseMessage $responseMessage;

    /**
     * PrimeNumber constructor.
     * @param RequestedNumbersRepository $numbersRepo
     * @param HttpResponse $httpResponse
     * @param ResponseMessage $responseMessage
     */
    public function __construct(
        RequestedNumbersRepository $numbersRepo,
        HttpResponse $httpResponse,
        ResponseMessage $responseMessage
    )
    {
        $this->numbersRepo     = $numbersRepo;
        $this->httpResponse    = $httpResponse;
        $this->responseMessage = $responseMessage;
    }

    /**
     * @param $number
     * @return bool
     *
     * @todo: optimize for big numbers
     */
    public function isPrime($number): bool
    {
        if($number == 1)
        {
            return false;
        }

        if($number == 2)
        {
            return true;
        }

        for($i = 2; $i < $number; $i++ )
        {
            if($number % $i === 0)
            {
                return false;
            }
        }

        return true;
    }

    /**
     * @param int $number
     * @return HttpResponse
     */
    public function store(int $number): HttpResponse
    {
        $model = $this->numbersRepo->getByNumber($number);

        if(!$model)
        {
           return $this->createNew($number);
        }

        return $this->update($model, $number);
    }

    /**
     * @param int $number
     * @return HttpResponse
     */
    public function createNew(int $number): HttpResponse
    {
        $isPrime = $this->isPrime($number);

        $model = $this->numbersRepo->store([
            'number'   => $number,
            'count'    => 1,
            'is_prime' => $isPrime
        ]);

        $this->responseMessage->setLevel($isPrime ? ResponseMessage::SUCCESS_LEVEL_ONE : ResponseMessage::FAIL_LEVEL_ONE);

        return $this->httpResponse->setStatusCode(201)
            ->setMessage($this->responseMessage->getMessage())
            ->setData([
                'number' => $model->getNumber(),
                'count'  => $model->getCount()
            ]);
    }

    /**
     * @param RequestedNumber $model
     * @param int $number
     * @return HttpResponse
     */
    public function update(RequestedNumber $model, int $number): HttpResponse
    {
        $isPrime = $this->isPrime($number);

        $count = $model->getCount() + 1;

        if($count > ResponseMessage::RAGE_STEP)
        {
            $this->httpResponse->setStatusCode(403); // Forbidden

            $this->responseMessage->setLevel(ResponseMessage::RAGE);
        }
        else
        {
            $this->httpResponse->setStatusCode(200);
            $this->responseMessage->setLevel(
                $isPrime ? ResponseMessage::SUCCESS_LEVEL_TWO : ResponseMessage::FAIL_LEVEL_TWO
            );
        }

        $this->numbersRepo->updateByNumber([
            'number'   => $number,
            'count'    => $count,
            'is_prime' => $isPrime
        ]);

        return $this->httpResponse->setMessage($this->responseMessage->getMessage())
            ->setData([
                'number' => $number,
                'count'  => $count
            ]);
    }

    /**
     * @param NumbersRange $range
     * @return HttpResponse
     */
    public function getAllByRange(NumbersRange $range): HttpResponse
    {
        $numbers = $this->numbersRepo->getByRange($range, hasPrimesOnly: false);

        return $this->httpResponse
            ->setStatusCode(200)
            ->setData(['numbers' => $numbers]);
    }

    /**
     * @param NumbersRange $range
     * @return HttpResponse
     */
    public function getPrimesByRange(NumbersRange $range): HttpResponse
    {
        $numbers = $this->numbersRepo->getByRange($range, hasPrimesOnly: true);

        return $this->httpResponse
            ->setStatusCode(200)
            ->setData(['numbers' => $numbers]);
    }
}
