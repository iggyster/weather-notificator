<?php

declare(strict_types=1);

namespace App\Factory;

use App\Util\Weather;

class WeatherFactory
{
    /**
     * @return Weather
     */
    public static function create(): Weather
    {
        return new Weather(getenv('OPEN_WEATHER_MAP_API_KEY'));
    }
}