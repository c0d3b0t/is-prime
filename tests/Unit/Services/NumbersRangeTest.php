<?php

namespace Tests\Unit\Services;

use App\Services\NumbersRange;
use Tests\TestCase;

class NumbersRangeTest extends TestCase
{
    private NumbersRange $range;

    protected function setUp(): void
    {
        parent::setUp();

        $this->range = new NumbersRange(1, 100);
    }

    public function testGetFrom()
    {
        $this->assertEquals(1, $this->range->getFrom());
    }

    public function testGetTo()
    {
        $this->assertEquals(100, $this->range->getTo());
    }
}
