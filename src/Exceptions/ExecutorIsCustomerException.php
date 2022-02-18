<?php

namespace TaskForce\Exceptions;

use Exception;

class ExecutorIsCustomerException extends Exception
{
    protected $message = 'Исполнитель не может быть заказчиком';
}
