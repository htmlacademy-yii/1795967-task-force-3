<?php

namespace TaskForce\Actions;

use TaskForce\Models\Task;

class ActionDone extends AbstractAction
{
    public function __construct(string $name, string $code)
    {
        $this->name = 'Завершить';
        $this->code = 'done';
    }

    public static function checkAvailable(Task $task, $userId): bool
    {

        if ($task->status !== Task::STATUS_IN_WORK) {
            return false;
        }

        if ($task->customerId !== $userId) {
            return false;
        }

        return true;
    }
}
