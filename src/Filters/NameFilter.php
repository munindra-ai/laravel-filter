<?php

declare(strict_types=1);

namespace Munindraai\LaravelFilter\Filters;

use Illuminate\Database\Eloquent\Builder;
use Closure;

class NameFilter
{
    public function handle(object $payload, Closure $next): object
    {
        if (!empty($payload->name)) {
            $payload->query->where('name', 'like', '%' . $payload->name . '%');
        }

        return $next($payload);
    }
}
