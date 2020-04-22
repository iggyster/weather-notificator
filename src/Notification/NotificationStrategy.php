<?php

declare(strict_types=1);

namespace App\Notification;

interface NotificationStrategy
{
    /**
     * @param string $to
     */
    public function notify(string $to);
}