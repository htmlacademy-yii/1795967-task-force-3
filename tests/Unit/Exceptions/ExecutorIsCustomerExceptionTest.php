<?php

namespace Unit\Exceptions;

use PHPUnit\Framework\TestCase;
use TaskForce\Exceptions\ExecutorIsCustomerException;
use TaskForce\Exceptions\IncorrectStatusException;
use TaskForce\Models\Task;

class ExecutorIsCustomerExceptionTest extends TestCase
{
    /**
     * @throws ExecutorIsCustomerException
     * @throws IncorrectStatusException
     */
    public function testException()
    {
        $this->expectException(ExecutorIsCustomerException::class);
        new Task(Task::STATUS_IN_WORK, 1, 1);

    }
}
