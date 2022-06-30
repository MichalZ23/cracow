<?php
declare(strict_types=1);

namespace App\Services;

use App\Entity\District;

class GetDistrictDataService
{
    public function getData(string $content): District
    {
        preg_match('/(?<=\<p\>Powierzchnia dzielnicy: \<strong\>)\d*,\d*(?= ha)/u', $content, $areaArray);
        preg_match('/(?<=\<strong\>)\s?\d*(?=\<\/strong>\<\/p\>)/u', $content, $populationArray);
        preg_match('/(?<=\<h1 class="bip"\>Dzielnica ).*(?=\<\/h1\>)/u', $content, $rowName);
        $area = $areaArray[0];
        $population = $populationArray[0];
        $name = '';
        $nameArray = explode(' ', $rowName[0]);
        $count = count($nameArray);
        for ($i = 0; $i < $count; $i++) {
            if ($i !== 0) {
                $name .= $nameArray[$i];
            }
            if ($i > 0 && $i !== $count - 1) {
                $name .= ' ';
            }
        }

        $city = 'Kraków';

        return new District($city, $name, (float)trim($area), (int)$population);
    }
}