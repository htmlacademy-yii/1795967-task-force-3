<?php

namespace TaskForce\Actions;
use TaskForce\Models\Task;


class ActionRefuse extends AbstractAction
{
    public function __construct()
    {
        $this->name = 'Отказаться';
        $this->code = 'refuse';
    }

    public static function checkAvailable(Task $task, $userId): bool
    {
        if ($task->status !== Task::STATUS_IN_WORK) {
            return false;
        }

        if ($task->executorId !== $userId) {
            return false;
        }

        return true;
    }

}
