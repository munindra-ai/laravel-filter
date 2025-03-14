<?php

declare(strict_types=1);

namespace Munindraai\LaravelFilter\Traits;

use Munindraai\LaravelFilter\Enums\WeekEnum;
use Munindraai\LaravelFilter\Filters\WeekFilter;
use Illuminate\Support\Facades\Pipeline;

trait HandlesWeeks
{
    protected ?WeekEnum $week = null;

    /**
     * Initialize the HandlesWeeks trait.
     */
    public function initializeHandlesWeeks(): void
    {
        $this->week = null;
    }

    /**
     * Select a week by string and convert it to the WeekEnum.
     */
    public function selectWeek(string $week): void
    {
        $this->setWeek(WeekEnum::tryFrom($week));
    }

    /**
     * Set the current week filter.
     */
    public function setWeek(?WeekEnum $week): void
    {
        $this->week = $week;
        $this->applyFilters($this->setFilterPayload($this->getQuery()));
    }

    /**
     * Apply filters to the query using Laravel's pipeline.
     */
    protected function applyFilters(object $filterPayload): object
    {
        return Pipeline::send($filterPayload)
            ->through($this->filters())
            ->thenReturn();
    }

    /**
     * Prepare the filter payload object.
     */
    protected function setFilterPayload($query): object
    {
        return (object) [
            'query' => $query,
            'week'  => $this->week,
        ];
    }

    /**
     * Define the filters to apply.
     */
    protected function filters(): array
    {
        return [
            WeekFilter::class,
        ];
    }

    /**
     * Get the query builder instance.
     * This must be implemented in the consuming class.
     */
    abstract protected function getQuery();
}
