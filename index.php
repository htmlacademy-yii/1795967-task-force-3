<?php

use TaskForce\Models\Task;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $task = new Task(Task::STATUS_IN_WORK, 1);
    $task->getStatusAfterAction(Task::ACTION_DONE);
} catch (\TaskForce\Exceptions\IncorrectStatusException $exception) {
    echo $exception->getMessage();
    echo ' 1 catch';
} catch (\TaskForce\Exceptions\ExecutorIsCustomerException $exception) {
    echo $exception->getMessage();
    echo ' 2 catch';
} catch (\TaskForce\Exceptions\IncorrectActionException $exception) {
    echo $exception->getMessage();
    echo ' 3 catch';
}
