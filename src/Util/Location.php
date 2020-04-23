<?php

declare(strict_types=1);

namespace App\Util;

class Location
{
    /**
     * @var string
     */
    protected $city;

    /**
     * @var string|null
     */
    protected $state;

    /**
     * @var string|null
     */
    protected $countryCode;

    /**
     * @param string      $city
     * @param string|null $state
     * @param string|null $countryCode
     */
    public function __construct(string $city, string $state = null, string $countryCode = null)
    {
        $this->city = $city;
        $this->state = $state;
        $this->countryCode = $countryCode;
    }

    public function __toString()
    {
        $location = $this->city;
        if (!$this->state) {
            $location .= ','.$this->state;
        }

        if (!$this->countryCode) {
            $location .= ','.$this->countryCode;
        }

        return $location;
    }
}