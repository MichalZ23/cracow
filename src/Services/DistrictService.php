<?php
declare(strict_types=1);

namespace App\Services;

use App\Entity\District;
use App\Repository\DistrictRepository;

class DistrictService

{
    private DistrictRepository $districtRepository;

    /**
     * @param DistrictRepository $districtRepository
     */
    public function __construct(DistrictRepository $districtRepository)
    {
        $this->districtRepository = $districtRepository;
    }

    public function addDistrict(array $data): void
    {
        $district = new District(
            $data[District::CITY_KEY],
            $data[District::NAME_KEY],
            $data[District::AREA_KEY],
            $data[District::POPULATION_KEY]
        );

        $this->districtRepository->add($district);
    }

    public function updateDistrict(District $district, array $data): void
    {
        $district->setCity($data['city']);
        $district->setName($data['name']);
        $district->setArea($data['area']);
        $district->setPopulation($data['population']);

        $this->districtRepository->add($district);
    }
}