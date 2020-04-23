<?php

declare(strict_types=1);

namespace App\Factory;

use App\Notification\Messages\NotificationMessage;
use App\Notification\Messages\ThessalonikiWeatherMessage;

final class MessageFactory
{
    /**
     * @return static
     */
    public static function create(): self
    {
        return new static();
    }

    public function createMessageForCountry(string $country): NotificationMessage
    {
        $messages = $this->getCountryMessages();
        if (!array_key_exists($country, $messages)) {
            throw new \LogicException('Seems like you forgot to define message');
        }

        return new $messages[$country]();
    }

    private function getCountryMessages(): array
    {
        return [
            'Thessaloniki' => ThessalonikiWeatherMessage::class,
        ];
    }
}
