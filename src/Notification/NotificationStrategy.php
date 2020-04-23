<?php

declare(strict_types=1);

namespace App\Notification;

use App\Notification\Messages\NotificationMessage;

interface NotificationStrategy
{
    public function notify(NotificationMessage $message): void;
}
