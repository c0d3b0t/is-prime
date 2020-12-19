<?php

namespace Tests\Unit\Services;

use App\Models\RequestedNumber;
use App\Repositories\RequestedNumbersRepository;
use App\Services\PrimeNumber;
use App\Services\HttpResponse;
use App\Services\ResponseMessage;
use PHPUnit\Framework\TestCase;

class PrimeNumberTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIsPrime()
    {
        $service = new PrimeNumber(
            new RequestedNumbersRepository(new RequestedNumber()),
            new HttpResponse(),
            new ResponseMessage()
        );

        $this->assertTrue($service->isPrime(2));
        $this->assertTrue($service->isPrime(7));
        $this->assertFalse($service->isPrime(1));
        $this->assertFalse($service->isPrime(4));
        $this->assertFalse($service->isPrime(8));
    }
}
