<?php

namespace App\Services;

class Response
{
    /**
     * @var int
     */
    private int $statusCode;

    /**
     * @var string
     */
    private string $message;

    /**
     * @var array
     */
    private array $data = [];

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $code
     * @return Response
     */
    public function setStatusCode(int $code): Response
    {
        $this->statusCode = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Response
     */
    public function setMessage(string $message): Response
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return Response
     */
    public function setData(array $data): Response
    {
        $this->data = $data;
        return $this;
    }



    /**
     * @return array
     */
    public function getArray(): array
    {
        return [
            'status_code' => $this->getStatusCode(),
            'message'     => $this->getMessage(),
            'data'        => $this->getData()
        ];
    }
}
