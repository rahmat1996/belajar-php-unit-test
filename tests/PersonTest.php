<?php

namespace Rahmat1996\Test;

use Exception;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    // using setUp to make not redundant using class person

    private Person $person;

    protected function setUp(): void
    {
        //$this->person = new Person("Rahmat");
    }

    /**
     * @before
     */
    public function createPerson()
    {
        $this->person = new Person("Rahmat");
    }

    public function testSuccess()
    {
        Assert::assertEquals("Hello Budi, My Name is Rahmat", $this->person->sayHello("Budi"));
    }

    public function testException()
    {
        $this->expectException(Exception::class);
        $this->person->sayHello(null);
    }

    public function testGoodByeSuccess()
    {
        // test ini akan diskip
        Assert::markTestSkipped("Test ini akan diskip");
        $this->expectOutputString("Good Bye Budi" . PHP_EOL);
        $this->person->sayGoodBye("Budi");
    }

    // function that execute after test case running.

    protected function tearDown(): void
    {
        echo "Tear Down" . PHP_EOL;
    }

    /**
     * @after
     */
    protected function after(): void
    {
        echo "After" . PHP_EOL;
    }

    // test not complete
    public function testIncomplete()
    {
        Assert::markTestIncomplete("Test not complete");
    }

    // skiped test with condition

    /**
     * @requires OSFAMILY Linux
     */
    public function testOnlyLinux()
    {
        Assert::assertTrue(true, "Only on Linux");
    }

    /**
     * @requires PHP >= 8
     * @requires OSFAMILY Windows
     */
    public function testOnlyOnWindowsAndPHP8()
    {
        Assert::assertTrue(true, "PHP 8 And Windows");
    }
}
