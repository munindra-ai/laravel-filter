<?php

declare(strict_types=1);

namespace Munindraai\LaravelFilter\Traits;

use Munindraai\LaravelFilter\Filters\NameFilter;
use Illuminate\Support\Facades\Pipeline;

trait HandlesEmail
{
    protected ?string $email = null;

    public function initializeHandlesEmail(): void
    {
        $this->email = null;
    }


    public function selectEmail(string $name): void
    {
        $this->setEmail($name);
    }

    public function setEmail(?string $name): void
    {
        $this->email = $name;
        $this->applyFilters($this->setFilterPayload($this->getQuery()));
    }

    protected function applyFilters(object $filterPayload): object
    {
        return Pipeline::send($filterPayload)
            ->through($this->filters())
            ->thenReturn();
    }

    protected function setFilterPayload($query): object
    {
        return (object) [
            'query' => $query,
            'email'  => $this->email,
        ];
    }

    abstract protected function getQuery();
}
