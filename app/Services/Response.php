<?php

namespace App\Services;

class Response
{
    /**
     * @var int
     */
    private int $code;

    /**
     * @var string
     */
    private string $message;

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return Response
     */
    public function setStatusCode(int $code): Response
    {
        $this->code = $code;
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
    public function getArray(): array
    {
        return [
            'status' => $this->getStatusCode(),
            'message' => $this->getMessage()
        ];
    }
}
