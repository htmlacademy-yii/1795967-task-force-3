<?php

namespace Unit\Exceptions;

use PHPUnit\Framework\TestCase;
use TaskForce\Exceptions\ExecutorIsCustomerException;
use TaskForce\Exceptions\IncorrectStatusException;
use TaskForce\Models\Task;

class IncorrectStatusExceptionTest extends TestCase
{
    /**
     * @throws ExecutorIsCustomerException
     */
    public function testException()
    {
        $this->expectException(IncorrectStatusException::class);
        new Task('xxx', 1);
    }
}
