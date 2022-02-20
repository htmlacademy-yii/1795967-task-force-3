<?php

namespace TaskForce\Models;

use TaskForce\Actions\ActionCancel;
use TaskForce\Actions\ActionDone;
use TaskForce\Actions\ActionRefuse;
use TaskForce\Actions\ActionRespond;
use TaskForce\Actions\ActionStart;
use TaskForce\Exceptions\ExecutorIsCustomerException;
use TaskForce\Exceptions\IncorrectActionException;
use TaskForce\Exceptions\IncorrectStatusException;

class Task
{
    public const STATUS_NEW = 'new';
    public const STATUS_CANCELED = 'canceled';
    public const STATUS_IN_WORK = 'in_work';
    public const STATUS_PERFORMED = 'performed';
    public const STATUS_FAILED = 'failed';
    public const ACTION_CANCEL = 'cancel';
    public const ACTION_RESPOND = 'respond';
    public const ACTION_DONE = 'done';
    public const ACTION_REFUSE = 'refuse';
    public const ACTION_START = 'start';

    public ?int $executorId;
    public int $customerId;
    public string $status;

    /**
     * @throws ExecutorIsCustomerException
     * @throws IncorrectStatusException
     */
    public function __construct(string $status, int $customerId, ?int $executorId = Null)
    {
        if (!in_array($status, array_keys($this->getStatusMap()))) {
            throw new IncorrectStatusException();

        }
        $this->status = $status;
        if ($customerId === $executorId) {
            throw new ExecutorIsCustomerException();
        }

        $this->customerId = $customerId;
        $this->executorId = $executorId;

    }

    public function getStatusMap(): array
    {
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_CANCELED => 'Отменен',
            self::STATUS_IN_WORK => 'В работе',
            self::STATUS_PERFORMED => 'Выполнено',
            self::STATUS_FAILED => 'Провалено'
        ];
    }

    public function getActionMap(): array
    {
        return [
            self::ACTION_CANCEL => 'Отменить',
            self::ACTION_RESPOND => 'Откликнуться',
            self::ACTION_DONE => 'Завершить',
            self::ACTION_REFUSE => 'Отказаться',
            self::ACTION_START => 'Запустить',
        ];
    }

    /**
     * @throws IncorrectActionException
     */
    public function getStatusAfterAction(string $action): string
    {
        if (!in_array($action, array_keys($this->getActionMap()))) {
            throw new IncorrectActionException();
        }

        switch ($action):
            case self::ACTION_CANCEL:
                return self::STATUS_CANCELED;
            case self::ACTION_START:
                return self::STATUS_IN_WORK;
            case self::ACTION_REFUSE:
                return self::STATUS_FAILED;
            case self::ACTION_DONE:
                return self::STATUS_PERFORMED;
            default:
                return $action;
        endswitch;
    }

    public function getAvailableActions(int $userId): array
    {
        $actions = [];

        if (ActionCancel::checkAvailable($this, $userId)) {
            $actions[] = new ActionCancel();
        }

        if (ActionRespond::checkAvailable($this, $userId)) {
            $actions[] = new ActionRespond();
        }

        if (ActionStart::checkAvailable($this, $userId)) {
            $actions[] = new ActionStart();
        }

        if (ActionDone::checkAvailable($this, $userId)) {
            $actions[] = new ActionDone();
        }

        if (ActionRefuse::checkAvailable($this, $userId)) {
            $actions[] = new ActionRefuse();
        }
        return $actions;
    }
}


