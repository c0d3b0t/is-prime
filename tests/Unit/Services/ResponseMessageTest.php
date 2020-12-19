<?php

namespace Tests\Unit\Services;

use App\Services\ResponseMessage;
use Tests\TestCase;

class ResponseMessageTest extends TestCase
{
    public function testGetMessage()
    {
        $responseMessage = new ResponseMessage();

        $responseMessage->setLevel(ResponseMessage::SUCCESS_LEVEL_ONE);
        $this->assertEquals(ResponseMessage::SUCCESS_LEVEL_ONE_MESSAGE, $responseMessage->getMessage());

        $responseMessage->setLevel(ResponseMessage::SUCCESS_LEVEL_TWO);
        $this->assertEquals(ResponseMessage::SUCCESS_LEVEL_TWO_MESSAGE, $responseMessage->getMessage());

        $responseMessage->setLevel(ResponseMessage::FAIL_LEVEL_ONE);
        $this->assertEquals(ResponseMessage::FAIL_LEVEL_ONE_MESSAGE, $responseMessage->getMessage());

        $responseMessage->setLevel(ResponseMessage::FAIL_LEVEL_TWO);
        $this->assertEquals(ResponseMessage::FAIL_LEVEL_TWO_MESSAGE, $responseMessage->getMessage());

        $responseMessage->setLevel(ResponseMessage::RAGE);
        $this->assertEquals(ResponseMessage::RAGE_MESSAGE, $responseMessage->getMessage());


    }
}
