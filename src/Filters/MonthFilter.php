<?php

declare(strict_types=1);

namespace Munindraai\LaravelFilter\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Closure;
use Munindraai\LaravelFilter\Enums\MonthEnum;

class MonthFilter
{
    public function handle(object $payload, Closure $next): object
    {

        if (!empty($payload->month) && $payload->month instanceof MonthEnum) {
            $monthNumber = Carbon::parse($payload->month->value)->month;
            $payload->query->whereMonth('created_at', $monthNumber);
        }

        return $next($payload);
    }
}
