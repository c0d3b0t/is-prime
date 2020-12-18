<?php

namespace Tests\Unit\Services;

use App\Services\Response;
use Tests\TestCase;

class ResponseTest extends TestCase
{
    /**
     * @var Response
     */
    private Response $response;

    protected function setUp(): void
    {
        parent::setUp();

        $this->response = new Response();
    }

    public function testStatusCode()
    {
        $statusCode = 200;

        $this->response->setStatusCode($statusCode);

        $this->assertEquals($statusCode, $this->response->getStatusCode());
    }

    public function testMessage()
    {
        $message = 'Some valuable message.';

        $this->response->setMessage($message);

        $this->assertEquals($message, $this->response->getMessage());
    }

    public function testData()
    {
        $data = ['foo' => 'bar'];

        $this->response->setData($data);

        $responseData = $this->response->getData();

        $this->assertIsArray($responseData);
        $this->assertEquals($data['foo'], $responseData['foo']);
    }

    public function testGetArray()
    {
        $key     = 'foo';
        $value   = 'bar';
        $message = 'Some valuable message.';

        $this->response
            ->setStatusCode(200)
            ->setMessage($message)
            ->setData([$key => $value]);

        $responseArr = $this->response->getArray();

        $this->assertIsArray($responseArr);
        $this->assertArrayHasKey('status_code', $responseArr);
        $this->assertArrayHasKey('message', $responseArr);
        $this->assertArrayHasKey('data', $responseArr);
        $this->assertIsArray($responseArr['data']);
        $this->assertArrayHasKey($key, $responseArr['data']);
        $this->assertEquals(200, $responseArr['status_code']);
        $this->assertEquals($message, $responseArr['message']);
        $this->assertEquals($value, $responseArr['data'][$key]);
    }
}
