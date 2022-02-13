<?php

namespace TaskForce\Action;
use TaskForce\Models\Task;


class ActionDone extends AbstractAction
{
    public function __construct()
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
