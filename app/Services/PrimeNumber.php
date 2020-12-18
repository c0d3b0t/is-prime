<?php

namespace App\Services;

use App\Models\RequestedNumber;
use App\Repositories\RequestedNumbersRepository;
use Illuminate\Http\Request;

class PrimeNumber
{
    /**
     * @var RequestedNumbersRepository
     */
    private RequestedNumbersRepository $repo;

    /**
     * PrimeNumber constructor.
     * @param RequestedNumbersRepository $repo
     */
    public function __construct(RequestedNumbersRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param $number
     * @return bool
     */
    public function isPrime($number): bool
    {
        if($number == 1) {
            return false;
        }

        if($number == 2) {
            return true;
        }

        for($i = 2; $i < $number; $i++ ) {
            if($number % $i === 0) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param int $number
     * @return Response
     */
    public function store(int $number): Response
    {
        $model = $this->repo->getByNumber($number);

        if(!$model)
        {
           return $this->createNew($number);
        }

        return $this->update($model, $number);
    }

    /**
     * @param int $number
     * @return Response
     */
    public function createNew(int $number): Response
    {
        $response = new Response();

        $isPrime = $this->isPrime($number);

        $model = $this->repo->store([
            'number'   => $number,
            'count'    => 1,
            'is_prime' => $isPrime
        ]);

        $message = $isPrime ? "Yes, {$number} IS a prime number!" : "No, {$number} IS NOT a prime number.";

        return $response->setStatusCode(200)
            ->setMessage($message)
            ->setData([
                'number' => $model->getNumber(),
                'count'  => $model->getCount()
            ]);
    }

    /**
     * @param RequestedNumber $model
     * @param int $number
     * @return Response
     */
    public function update(RequestedNumber $model, int $number): Response
    {
        $response = new Response();

        $isPrime = $this->isPrime($number);

        $count = $model->getCount() + 1;

        if($count > 10)
        {
            $response->setStatusCode(403); // Forbidden
            $message = "You're insane, we don't want to answer anymore.";
        }
        else
        {
            $response->setStatusCode(200);
            $answer = $this->isPrime($number) ? 'YES' : 'No';
            $message = "{$answer}, and we already told you so";
            $message .= $count > 2 ? " {$count} times!" : '!';
        }

        $this->repo->updateByNumber([
            'number'   => $number,
            'count'    => $count,
            'is_prime' => $isPrime
        ]);

        return $response->setMessage($message)
            ->setData([
                'number' => $number,
                'count'  => $count
            ]);
    }
}
