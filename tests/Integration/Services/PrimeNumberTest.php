<?php

namespace Tests\Integration\Services;

use App\Models\RequestedNumber;
use App\Repositories\RequestedNumbersRepository;
use App\Services\PrimeNumber;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PrimeNumberTest extends TestCase
{
    use DatabaseMigrations;

    private PrimeNumber $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new PrimeNumber(new RequestedNumbersRepository(new RequestedNumber()));
    }

    public function testStore()
    {
        $number   = 7;
        $response = $this->service->store($number);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("Yes, {$number} IS a prime number!", $response->getMessage());
        $this->assertEquals(1, $response->getData()['count']);

        $response = $this->service->store($number);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("YES, and we already told you so!", $response->getMessage());
        $this->assertEquals(2, $response->getData()['count']);

        for($i = 0; $i < 9; $i++)
        {
            $response = $this->service->store($number);
        }

        $this->assertEquals(403, $response->getStatusCode());
        $this->assertEquals("You're insane, we don't want to answer anymore.", $response->getMessage());
        $this->assertEquals(11, $response->getData()['count']);
    }
}
