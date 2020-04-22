<?php

declare(strict_types=1);

namespace App\Util;

use Cmfcmf\OpenWeatherMap;
use Http\Adapter\Guzzle6\Client;
use Http\Factory\Guzzle\RequestFactory;

class Weather
{
    public function __construct()
    {
        $requestFactory = new RequestFactory();
        $client = Client::createWithConfig([]);

        $this->map = new OpenWeatherMap(getenv('OPEN_WEATHER_MAP_API_KEY'), $client, $requestFactory);
    }
}