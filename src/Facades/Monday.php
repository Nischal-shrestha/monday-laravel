<?php

namespace Nishstha\Monday\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void call(string $query, boolean $getData = false)
 * @method static null|\GuzzleHttp\Psr7\Response getResponse()
 * @method static boolean|object getResponseData()
 *
 * @see \Barryvdh\Debugbar\LaravelDebugbar
 */
class Monday extends Facade
{
  public static function getFacadeAccessor()
  {
    return 'monday';
  }
}
