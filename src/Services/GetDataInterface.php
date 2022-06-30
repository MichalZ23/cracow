<?php
declare(strict_types=1);

namespace App\Services;

use App\Entity\District;

interface GetDataInterface
{
    public function getData(string $content): District;
}