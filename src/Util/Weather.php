<?php

declare(strict_types=1);

namespace App\Util;

use App\Exception\WeatherException;
use Cmfcmf\OpenWeatherMap;
use Http\Adapter\Guzzle6\Client;
use Http\Factory\Guzzle\RequestFactory;

class Weather
{
    /**
     * @var OpenWeatherMap
     */
    private $map;

    /**
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $requestFactory = new RequestFactory();
        $client = Client::createWithConfig([]);

        $this->map = new OpenWeatherMap($apiKey, $client, $requestFactory);
    }

    /**
     * @param Location $location
     * @param string   $unit
     *
     * @return OpenWeatherMap\Util\Temperature
     * @throws WeatherException
     */
    public function getByLocation(Location $location, string $unit = 'metric'): OpenWeatherMap\Util\Temperature
    {
        try {
            $weather = $this->map->getWeather((string) $location, $unit);
        } catch (\Exception $exception) {
            throw new WeatherException($exception->getMessage());
        }

        return $weather->temperature;
    }
}