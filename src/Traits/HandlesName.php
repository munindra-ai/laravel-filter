<?php

declare(strict_types=1);

namespace Munindraai\LaravelFilter\Traits;

use Munindraai\LaravelFilter\Filters\NameFilter;
use Illuminate\Support\Facades\Pipeline;

trait HandlesName
{
    protected ?string $name = null;

    /**
     * Initialize the HandlesName trait.
     */
    public function initializeHandlesName(): void
    {
        $this->name = null;
    }

    /**
     * Select a name.
     */
    public function selectName(string $name): void
    {
        $this->setName($name);
    }

    /**
     * Set the current name filter.
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
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
            'name'  => $this->name,
        ];
    }

    /**
     * Define the filters to apply.
     */
    protected function filters(): array
    {
        return [
            NameFilter::class,
        ];
    }

    /**
     * Get the query builder instance.
     * This must be implemented in the consuming class.
     */
    abstract protected function getQuery();
}
