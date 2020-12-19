<?php

namespace App\Services;

class HttpResponse
{
    /**
     * @var int
     */
    private int $statusCode;

    /**
     * @var string
     */
    private string $message = '';

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
     * @return HttpResponse
     */
    public function setStatusCode(int $code): HttpResponse
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
     * @return HttpResponse
     */
    public function setMessage(string $message): HttpResponse
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
     * @return HttpResponse
     */
    public function setData(array $data): HttpResponse
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
