<?php

declare(strict_types=1);

namespace App\Notification;

class SMSNotificationStrategy implements NotificationStrategy
{
    public function __construct()
    {
        $this->routee = RouteeFactory::create();
    }

    /**
     * @inheritDoc
     */
    public function notify(string $to)
    {
        $this->routee->
    }
}