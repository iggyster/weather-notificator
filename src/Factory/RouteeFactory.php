<?php

declare(strict_types=1);

namespace App\Factory;

use App\Util\Routee;

class RouteeFactory
{
    /**
     * @return Routee
     */
    public static function create(): Routee
    {
        return new Routee(getenv('ROUTEE_APP_ID'), getenv('ROUTEE_APP_SECRET'));
    }
}