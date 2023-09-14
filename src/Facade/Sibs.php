<?php

namespace MichelMelo\Sibs\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class Sibs.
 */
class Sibs extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'sibs';
    }
}
