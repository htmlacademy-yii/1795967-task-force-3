<?php

namespace TaskForce\Actions;
//use Task;
use TaskForce\Models\Task;

class ActionRespond extends AbstractAction
{
public function __construct() {
    $this->name = 'Откликнуться';
    $this->code = 'respond';
}
    public static function checkAvailable(Task $task, $userId): bool
    {
        if ($task->status !== Task::STATUS_NEW) {
            return false;
        }

        if ($task->executorId !== $userId) {
            return false;
        }

        return true;
    }
}
