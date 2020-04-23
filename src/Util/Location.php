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
     * @var null|string
     */
    protected $state;

    /**
     * @var null|string
     */
    protected $countryCode;

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
