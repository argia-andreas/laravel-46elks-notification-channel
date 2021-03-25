<?php

namespace Grafstorm\FortySixElksChannel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Grafstorm\FortySixElksChannel\FortySixElksChannel
 */
class FortySixElks extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-46elks-notification-channel';
    }
}
