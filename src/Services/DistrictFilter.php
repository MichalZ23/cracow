<?php
declare(strict_types=1);

namespace App\Services;

use App\Controller\ShowAllController;

class DistrictFilter
{
    private string $sortColumn;
    private string $sortDirection;
    private ?string $filter;
    private string $filterColumn;

    /**
     * @param string $sortColumn
     * @param string $sortDirection
     * @param ?string $filter
     * @param string $filterColumn
     */
    public function __construct(string $sortColumn, string $sortDirection, ?string $filter, string $filterColumn)
    {
        $this->sortColumn = $sortColumn;
        $this->sortDirection = $sortDirection;
        $this->filter = $filter;
        $this->filterColumn = $filterColumn;
    }

    /**
     * @return string
     */
    public function getSortColumn(): string
    {
        return $this->sortColumn;
    }

    /**
     * @return string
     */
    public function getSortDirection(): string
    {
        return $this->sortDirection;
    }

    /**
     * @return ?string
     */
    public function getFilter(): ?string
    {
        return $this->filter;
    }

    /**
     * @return string
     */
    public function getFilterColumn(): string
    {
        return $this->filterColumn;
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            $data[ShowAllController::SORT_COLUMN_KEY],
            $data[ShowAllController::SORT_DIRECTION_KEY],
            $data[ShowAllController::FILTER_KEY],
            $data[ShowAllController::FILTER_COLUMN_KEY]
        );
    }

}