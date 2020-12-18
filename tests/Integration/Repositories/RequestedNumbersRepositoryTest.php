<?php

namespace Tests\Integration\Repositories;

use App\Models\RequestedNumber;
use App\Repositories\RequestedNumbersRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RequestedNumbersRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private RequestedNumbersRepository $repo;

    public function setUp(): void
    {
        parent::setUp();

        $this->repo = new RequestedNumbersRepository(new RequestedNumber());
    }

    public function testGetByNumber()
    {
        $number = 23;
        $data   = ['number' => $number, 'is_prime' => true];

        $this->repo->store($data);

        $model = $this->repo->getByNumber($number);

        $this->assertEquals($number, $model->getNumber());
    }

    public function testStore()
    {
        $number = 13;
        $data   = ['number' => $number, 'is_prime' => true, 'count' => 1];
        $model  = $this->repo->store($data);

        $this->assertEquals($number, $model->getNumber());
        $this->assertEquals(1, $model->getCount());
        $this->assertEquals(true, $model->isPrime());
    }

    public function testUpdateByNumber()
    {
        $number = 17;
        $data   = ['number' => $number, 'is_prime' => true];

        $this->repo->store($data);

        $data['count'] = 3;

       $this->repo->updateByNumber($data);


        $model = $this->repo->getByNumber($number);

        $this->assertEquals(3, $model->getCount());
    }
}
