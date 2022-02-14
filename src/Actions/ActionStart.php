<?php

namespace TaskForce\Actions;
use TaskForce\Models\Task;


class ActionStart extends AbstractAction
{
    public function __construct()
    {
        $this->name = 'Запустить';
        $this->code = 'start';
    }

    public static function checkAvailable(Task $task, $userId): bool
    {

        if ($task->status !== Task::STATUS_NEW) {
            return false;
        }

        if ($task->customerId !== $userId) {
            return false;
        }
        return true;
    }
}
