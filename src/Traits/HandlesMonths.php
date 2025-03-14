<?php

namespace Munindraai\LaravelFilter\Traits;

use Munindraai\LaravelFilter\Enums\MonthEnum;
use Munindraai\LaravelFilter\Filters\MonthFilter;
use Illuminate\Support\Facades\Pipeline;

trait HandlesMonths
{
    public $month = ''; // This will hold the selected month.

    public function initializeMonth()
    {
        $this->month = null;
    }

    public function selectMonth(string $month)
    {
        $this->setMonth(MonthEnum::tryFrom($month));
    }

    public function setMonth(?MonthEnum $month)
    {
        $this->month = $month;
        $this->applyFilters($this->setFilterPayload($this->getQuery()));
    }

    public function applyFilters($filterPayload)
    {
        return Pipeline::send($filterPayload)
            ->through([
                MonthFilter::class,  // Apply the month filter
            ])
            ->thenReturn();
    }

    public function setFilterPayload($query)
    {
        return (object) [
            'query' => $query,
            'month' => $this->month,
        ];
    }

    abstract protected function getQuery();
}
