<?php

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

    public $executorId;
    public $customerId;
    public $status;
    public $action;
    public $userId;

    public function __construct($executorId, $customerId, $status)
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
            self::ACTION_DONE => 'Выполнено',
            self::ACTION_REFUSE => 'Отказаться'
        ];
    }

    private function getStatus() {
        switch($this->action):
            case self::ACTION_CANCEL:
                $this->status = self::STATUS_CANCELED;
                break;
            case self::ACTION_RESPOND:
                $this->status = self::STATUS_IN_WORK;
                break;
            case self::ACTION_REFUSE:
                $this->status = self::STATUS_FAILED;
                break;
            case self::ACTION_DONE:
                $this->status = self::STATUS_PERFORMED;
                break;
            endswitch;
        return $this->status;
    }

    private function getAction($userId) {
        switch($this->status):
            case self::STATUS_NEW:
                if($userId === $this->customerId):
                    $this->action = self::ACTION_CANCEL;
                endif;
                    break;
            case self::STATUS_NEW:
                if($userId === $this->executorId):
                    $this->action = self::ACTION_RESPOND;
                endif;
                    break;
            case self::STATUS_IN_WORK:
                if($userId === $this->customerId):
                    $this->action = self::ACTION_DONE;
                endif;
                    break;
            case self::STATUS_IN_WORK:
                if($userId === $this->executorId):
                    $this->action = self::ACTION_REFUSE;
                endif;
                    break;
            endswitch;
        return $this->action;
    }
}


