<?php

namespace TaskForce\Exceptions;

use Exception;

class IncorrectStatusException extends Exception
{
    protected $message = 'Некорректный статус';
}
