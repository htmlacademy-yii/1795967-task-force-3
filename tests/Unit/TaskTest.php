<?php
namespace Tests\Unit;
use PHPUnit\Framework\TestCase;
use Task;

require_once __DIR__. '/../../Task.php';

class TaskTest extends TestCase
{
    public function testGetStatusAfterAction()
    {
        $task = new Task(Task::STATUS_NEW, 1);
        $status = $task->getStatusAfterAction(Task::ACTION_CANCEL);
        $this->assertEquals('canceled', $status);

        $task = new Task(Task::STATUS_IN_WORK, 1);
        $status = $task->getStatusAfterAction(Task::ACTION_DONE);
        $this->assertEquals('performed', $status);

        $task = new Task(Task::STATUS_NEW, 0,1);
        $status = $task->getStatusAfterAction(Task::ACTION_RESPOND);
        $this->assertEquals('in_work', $status);

        $task = new Task(Task::STATUS_IN_WORK, 0, 1);
        $status = $task->getStatusAfterAction(Task::ACTION_REFUSE);
        $this->assertEquals('failed', $status);
    }

    public function testGetAvailableActions()
    {
        $task = new Task(Task::STATUS_NEW, 1);
        $actions = $task->getAvailableActions($task->executorId);
        $this->assertEquals(['respond'], $actions);

        $task = new Task(Task::STATUS_NEW, 1);
        $actions = $task->getAvailableActions($task->customerId);
        $this->assertEquals(['cancel'], $actions);

        $task = new Task(Task::STATUS_IN_WORK, 1);
        $actions = $task->getAvailableActions($task->executorId);
        $this->assertEquals(['refuse'], $actions);

        $task = new Task(Task::STATUS_IN_WORK,1);
        $actions = $task->getAvailableActions($task->customerId);
        $this->assertEquals(['done'], $actions);

    }
}

