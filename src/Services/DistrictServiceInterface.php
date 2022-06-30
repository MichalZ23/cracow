<?php
declare(strict_types=1);

namespace App\Services;

use App\Entity\District;

interface DistrictServiceInterface
{
    public function addDistrict(array $data): void;

    public function updateDistrict(District $district, array $data): void;
}