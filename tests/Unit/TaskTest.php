<?php
namespace Unit;
use PHPUnit\Framework\TestCase;
use TaskForce\Task;

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
        $status = $task->getStatusAfterAction(Task::ACTION_START);
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
        $this->assertEquals(['cancel', 'start'], $actions);

        $task = new Task(Task::STATUS_IN_WORK, 1);
        $actions = $task->getAvailableActions($task->executorId);
        $this->assertEquals(['refuse'], $actions);

        $task = new Task(Task::STATUS_IN_WORK,1);
        $actions = $task->getAvailableActions($task->customerId);
        $this->assertEquals(['done'], $actions);

    }
}

