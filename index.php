<?php
use TaskForce\Models\Task;
use TaskForce\Action\ActionCancel;
require_once __DIR__ .'/vendor/autoload.php';

$task = new Task(Task::STATUS_NEW, 1);
$result = $task->getStatusAfterAction(Task::ACTION_START);
echo "$result \n";

$task1 = new Task(Task::STATUS_IN_WORK,1);
$result1 = $task1->getAvailableActions($task1->customerId);
var_dump($result1);
print_r( $result1);

