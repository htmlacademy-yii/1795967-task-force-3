<?php
use TaskForce\Models\Task;
use TaskForce\Action\ActionCancel;
require_once __DIR__ .'/vendor/autoload.php';

$task = new Task(Task::STATUS_NEW, 1);
$result = $task->getStatusAfterAction(Task::ACTION_START);
echo "$result \n";



