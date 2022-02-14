<?php

namespace Unit;
use PHPUnit\Framework\TestCase;
use TaskForce\Actions\ActionDone;
use TaskForce\Actions\ActionRefuse;
use TaskForce\Actions\ActionRespond;
use TaskForce\Actions\ActionCancel;
use TaskForce\Actions\ActionStart;
use TaskForce\Models\Task;

//use TaskForce\Actions\ActionStart;
//use TaskForce\Actions\ActionDone;
//use TaskForce\Actions\ActionRefuse;


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
        $task = new Task(Task::STATUS_NEW, 1 );
        $actions = $task->getAvailableActions($task->customerId);
        $this->assertEquals([new ActionCancel(), new ActionStart()], $actions);

        $task = new Task(Task::STATUS_NEW, 0, 1 );
        $actions = $task->getAvailableActions($task->executorId);
        $this->assertEquals([new ActionRespond()], $actions);

        $task = new Task(Task::STATUS_IN_WORK, 1 );
        $actions = $task->getAvailableActions($task->customerId);
        $this->assertEquals([new ActionDone()], $actions);

        $task = new Task(Task::STATUS_IN_WORK, 0, 1 );
        $actions = $task->getAvailableActions($task->executorId);
        $this->assertEquals([new ActionRefuse()], $actions);
//
//        $task = new Task(Task::STATUS_NEW, 1);
//        $actions = $task->getAvailableActions($task->customerId);
//        $this->assertEquals(['cancel', 'start'], $actions);
//
//        $task = new Task(Task::STATUS_IN_WORK, 1);
//        $actions = $task->getAvailableActions($task->executorId);
//        $this->assertEquals(['refuse'], $actions);
//
//        $task = new Task(Task::STATUS_IN_WORK,1);
//        $actions = $task->getAvailableActions($task->customerId);
//        $this->assertEquals(['done'], $actions);

    }
}

