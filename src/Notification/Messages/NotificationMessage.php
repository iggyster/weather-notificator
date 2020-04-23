<?php

declare(strict_types=1);

namespace App\Notification\Messages;

abstract class NotificationMessage
{
    private $sender;
    private $receiver;

    abstract public function getMessage(): string;

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return mixed
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * @param $receiver
     */
    public function setReceiver($receiver): void
    {
        $this->receiver = $receiver;
    }

    /**
     * @param $sender
     */
    public function setSender($sender): void
    {
        $this->sender = $sender;
    }
}
