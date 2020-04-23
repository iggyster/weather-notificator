<?php

declare(strict_types=1);

namespace App\Factory;

use App\Notification\NotificationStrategy;
use App\Notification\SMSNotificationStrategy;

final class NotificationStrategyFactory
{
    /**
     * @return NotificationStrategyFactory
     */
    public static function create(): self
    {
        return new static();
    }

    public function createStrategy(string $type): NotificationStrategy
    {
        $strategies = [
            'sms' => SMSNotificationStrategy::class,
        ];
        if (!array_key_exists($type, $strategies)) {
            throw new \LogicException('Seems like you forgot to define a strategy');
        }

        return new $strategies[$type]();
    }
}
