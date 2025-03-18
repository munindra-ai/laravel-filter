<?php

declare(strict_types=1);

namespace Munindraai\LaravelFilter\Filters;

use Closure;

class EmailFilter
{
    public function handle(object $payload, Closure $next)
    {
        if (!empty($payload->email)) {
            $payload->query->where('email', 'like', '%' . $payload->email . '%');
        }

        return $next($payload);
    }
}
