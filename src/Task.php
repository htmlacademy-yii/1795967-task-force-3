<?php
namespace TaskForce;

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

    public $executorId;
    public $customerId;
    public $status;

    public function __construct($status, $customerId, $executorId = Null)
    {
        $this->executorId = $executorId;
        $this->customerId = $customerId;
        $this->status = $status;

    }

    public function getStatusMap()
    {
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_CANCELED => 'Отменен',
            self::STATUS_IN_WORK => 'В работе',
            self::STATUS_PERFORMED => 'Выполнено',
            self::STATUS_FAILED => 'Провалено'
        ];
    }

    public function getActionMap()
    {
        return [
            self::ACTION_CANCEL => 'Отменить',
            self::ACTION_RESPOND => 'Откликнуться',
            self::ACTION_DONE => 'Завершить',
            self::ACTION_REFUSE => 'Отказаться',
            self::ACTION_START => 'Запустить',
        ];
    }

    public function getStatusAfterAction($actions) {
        switch($actions):
            case self::ACTION_CANCEL:
               return self::STATUS_CANCELED;
            case self::ACTION_START:
                return self::STATUS_IN_WORK;
            case self::ACTION_REFUSE:
                return self::STATUS_FAILED;
            case self::ACTION_DONE:
                return self::STATUS_PERFORMED;
            default:
               return $actions;
            endswitch;
    }

    public function getAvailableActions($userId)
    {
        $actions = [];
       if ($userId === $this->customerId) {
        switch($this->status):
            case self::STATUS_NEW:
                $actions[] = self::ACTION_CANCEL;
                $actions[] = self::ACTION_START;
                break;
            case self::STATUS_IN_WORK:
                $actions[] = self::ACTION_DONE;
                break;
            endswitch;
       }
        if ($userId === $this->executorId) {
            switch($this->status):
                case self::STATUS_NEW:
                    $actions[] = self::ACTION_RESPOND;
                    break;
                case self::STATUS_IN_WORK:
                    $actions[] = self::ACTION_REFUSE;
                    break;
            endswitch;
        }
        return $actions;
    }
}


