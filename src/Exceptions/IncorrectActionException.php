<?php

namespace TaskForce\Exceptions;

use Exception;

class IncorrectActionException extends Exception
{
    protected $message = 'Некорректное действие';
}
