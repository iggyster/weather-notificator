<?php

declare(strict_types=1);

namespace App\Notification;

use App\Notification\Messages\NotificationMessage;

interface NotificationStrategy
{
    /**
     * @param NotificationMessage $message
     */
    public function notify(NotificationMessage $message): void;
}