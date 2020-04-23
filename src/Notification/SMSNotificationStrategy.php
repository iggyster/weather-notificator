<?php

declare(strict_types=1);

namespace App\Notification;

use App\Exception\RouteeException;
use App\Factory\RouteeFactory;
use App\Notification\Messages\NotificationMessage;
use App\Util\Routee;

class SMSNotificationStrategy implements NotificationStrategy
{
    /**
     * @var Routee
     */
    private $routee;

    public function __construct()
    {
        $this->routee = RouteeFactory::create();
    }

    /**
     * {@inheritdoc}
     *
     * @throws RouteeException
     */
    public function notify(NotificationMessage $message): void
    {
        $this->routee->sendSMS($message->getMessage(), $message->getReceiver(), $message->getSender());
    }
}
