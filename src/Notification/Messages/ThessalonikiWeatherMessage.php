<?php

declare(strict_types=1);

namespace App\Notification\Messages;

use App\Exception\WeatherException;
use App\Factory\WeatherFactory;
use App\Util\Location;
use App\Util\Weather;

class ThessalonikiWeatherMessage extends NotificationMessage
{
    /**
     * @var Weather
     */
    private $weather;

    public function __construct()
    {
        $this->weather = WeatherFactory::create();
    }

    /**
     * @inheritDoc
     *
     * @throws WeatherException
     */
    public function getMessage(): string
    {
        $location = new Location('Thessaloniki');

        $temperature = $this->weather->getByLocation($location);
        $degrees = $temperature->getValue();
        if ($degrees > 20) {
            return 'Temperature more than 20C. '.$degrees;
        }

        return 'Temperature less (or equal) then 20C. '.$degrees;
    }
}