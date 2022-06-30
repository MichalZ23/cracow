<?php
declare(strict_types=1);

namespace App\Services;

interface FilterServiceInterface
{
    public function filter(DistrictFilter $districtFilter): array;
}