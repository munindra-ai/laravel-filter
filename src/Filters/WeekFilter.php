<?php

declare(strict_types=1);

namespace Munindraai\LaravelFilter\Filters;

use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Munindraai\LaravelFilter\Enums\WeekEnum;

class WeekFilter
{
    public function handle(object $payload, Closure $next): object
    {
        if (!empty($payload->week) && $payload->week instanceof WeekEnum) {
            $weekDay = Carbon::parse($payload->week->value)->dayOfWeek;
            $payload->query->whereRaw('DAYOFWEEK(created_at) = ?', [$weekDay]);
        }

        return $next($payload);
    }
}
