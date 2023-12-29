<?php

namespace Rahmat1996\Test;

use Exception;

class Person
{
    public function __construct(private string $name)
    {
    }

    public function sayHello(?string $name)
    {
        if ($name == null) throw new Exception("Name is null");

        return "Hello $name, My Name is $this->name";
    }

    public function sayGoodBye(?string $name)
    {
        if ($name == null) throw new Exception("Name is null");

        echo "Good Bye $name" . PHP_EOL;
    }
}
