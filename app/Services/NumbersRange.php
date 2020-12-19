<?php

namespace App\Services;

class NumbersRange
{
    /**
     * @var int
     */
    private int $from;

    /**
     * @var int
     */
    private int $to;

    /**
     * NumbersRange constructor.
     * @param int $from
     * @param int $to
     */
    public function __construct(int $from, int $to)
    {
        $this->from = $from;
        $this->to   = $to;
    }

    /**
     * @return int
     */
    public function getFrom(): int
    {
        return $this->from;
    }

    /**
     * @return int
     */
    public function getTo(): int
    {
        return $this->to;
    }
}
