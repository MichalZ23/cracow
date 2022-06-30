<?php
declare(strict_types=1);

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

    public function filter(DistrictFilter $districtFilter): array
    {
        return $this->districtRepository->filter($districtFilter);
    }
}