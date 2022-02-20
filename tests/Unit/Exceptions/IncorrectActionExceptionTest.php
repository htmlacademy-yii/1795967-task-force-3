<?php

namespace Unit\Exceptions;

use PHPUnit\Framework\TestCase;
use TaskForce\Exceptions\ExecutorIsCustomerException;
use TaskForce\Exceptions\IncorrectActionException;
use TaskForce\Exceptions\IncorrectStatusException;
use TaskForce\Models\Task;

class IncorrectActionExceptionTest extends TestCase
{
    /**
     * @throws ExecutorIsCustomerException
     * @throws IncorrectStatusException
     */
    public function testException()
    {
        $this->expectException(IncorrectActionException::class);
        $task = new Task(Task::STATUS_IN_WORK, 1);
        $task->getStatusAfterAction('xxx');
    }

}
