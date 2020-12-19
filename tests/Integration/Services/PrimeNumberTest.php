<?php

namespace Tests\Integration\Services;

use App\Models\RequestedNumber;
use App\Repositories\RequestedNumbersRepository;
use App\Services\NumbersRange;
use App\Services\PrimeNumber;
use App\Services\HttpResponse;
use App\Services\ResponseMessage;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PrimeNumberTest extends TestCase
{
    use DatabaseMigrations;

    private PrimeNumber $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new PrimeNumber(
            new RequestedNumbersRepository(new RequestedNumber()),
            new HttpResponse(),
            new ResponseMessage()
        );
    }

    public function testStore()
    {
        // Test with prime number

        $number   = 7;
        $response = $this->service->store($number);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals(ResponseMessage::SUCCESS_LEVEL_ONE_MESSAGE, $response->getMessage());
        $this->assertEquals(1, $response->getData()['count']);

        $response = $this->service->store($number);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(ResponseMessage::SUCCESS_LEVEL_TWO_MESSAGE, $response->getMessage());
        $this->assertEquals(2, $response->getData()['count']);

        for($i = 0; $i < ResponseMessage::RAGE_STEP-1; $i++)
        {
            $response = $this->service->store($number);
        }

        $this->assertEquals(403, $response->getStatusCode());
        $this->assertEquals(ResponseMessage::RAGE_MESSAGE, $response->getMessage());
        $this->assertEquals(11, $response->getData()['count']);

        // Test with non-prime number

        $number = 8;

        $response = $this->service->store($number);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals(ResponseMessage::FAIL_LEVEL_ONE_MESSAGE, $response->getMessage());
        $this->assertEquals(1, $response->getData()['count']);

        $response = $this->service->store($number);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(ResponseMessage::FAIL_LEVEL_TWO_MESSAGE, $response->getMessage());
        $this->assertEquals(2, $response->getData()['count']);

        for($i = 0; $i < 9; $i++)
        {
            $response = $this->service->store($number);
        }

        $this->assertEquals(403, $response->getStatusCode());
        $this->assertEquals(ResponseMessage::RAGE_MESSAGE, $response->getMessage());
        $this->assertEquals(11, $response->getData()['count']);
    }

    public function testGetByRange()
    {
        $range = new NumbersRange(1, 10);

        $response = $this->service->getPrimesByRange($range);
        $data     = $response->getData();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('numbers', $data);
        $this->assertInstanceOf(Collection::class, $data['numbers'] );
    }
}
