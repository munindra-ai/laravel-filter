<?php

namespace Munindraai\LaravelFilter\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Munindraai\LaravelFilter\LaravelFilter
 */
class LaravelFilter extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Munindraai\LaravelFilter\LaravelFilter::class;
    }
}
