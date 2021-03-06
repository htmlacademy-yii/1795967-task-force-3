<?php

namespace TaskForce\Actions;

use phpDocumentor\Reflection\Types\ClassString;
use TaskForce\Models\Task;

class ActionCancel extends AbstractAction
{
    public function __construct()
    {
        $this->name = 'Отменить';
        $this->code = 'cancel';
    }

    public static function checkAvailable(Task $task, int $userId): bool
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
