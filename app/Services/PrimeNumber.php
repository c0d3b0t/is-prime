<?php

namespace App\Services;

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
     * @param $number
     * @return Response
     */
    public function handlePrime($number): Response
    {
        $response = new Response();

        $result = $this->repo->getByNumber($number);

        if(!$result)
        {
            $this->repo->store([
                'number' => $number,
                'count'  => 1
            ]);

            $message = $this->isPrime($number) ? "Yes, {$number} IS a prime number!" : "No, {$number} IS NOT a prime number.";

            return $response->setStatusCode(200)
                ->setMessage($message);
        }

        if($result['count'] > 10)
        {
            $response->setStatusCode(403); // Forbidden
            $message = "You're insane, we don't want to answer anymore.";
        }
        else
        {
            $response->setStatusCode(200);
            $answer = $this->isPrime($number) ? 'YES' : 'No';
            $message = "{$answer}, and we already told you so ";
            $message .= $result['count'] >= 2 ? "{$result['count']} times!" : '!';
        }

        return $response->setMessage($message);
    }
}
