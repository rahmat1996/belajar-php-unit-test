<?php

namespace Rahmat1996\Test;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Constraint\Count;
use PHPUnit\Framework\TestCase;

class CounterTest extends TestCase
{
    public function testCounter()
    {
        $counter = new Counter();

        $counter->increment();
        Assert::assertEquals(1, $counter->getCounter());

        $counter->increment();
        $this->assertEquals(2, $counter->getCounter()); // can use $this because class TestCase extends to Assert

        $counter->increment();
        self::assertEquals(3, $counter->getCounter()); // can use $this because class TestCase extends to Assert and assertEquals is static function
    }

    /**
     * @test
     */
    public function increment()
    {
        $counter = new Counter();

        $counter->increment();
        Assert::assertEquals(1, $counter->getCounter());
    }

    public function testFirst(): Counter
    {
        $counter = new Counter();
        $counter->increment();
        $counter->increment();
        $this->assertEquals(2, $counter->getCounter());
        return $counter;
    }

    /**
     * @depends testFirst
     */
    public function testSecond(Counter $counter): void
    {
        $counter->increment();
        $this->assertEquals(3, $counter->getCounter());
    }
}
