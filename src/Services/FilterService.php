<?php

namespace App\Services;

use App\Repository\DistrictRepository;

class FilterService
{
    private DistrictRepository $districtRepository;

    /**
     * @param DistrictRepository $districtRepository
     */
    public function __construct(DistrictRepository $districtRepository)
    {
        $this->districtRepository = $districtRepository;
    }

    public function filter(array $parameters): array
    {
        return $this->districtRepository->filter($parameters);
    }
}