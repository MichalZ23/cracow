<?php
declare(strict_types=1);

namespace App\Services;

use App\Entity\District;
use App\FetchDataException;

class GetDistrictDataService implements GetDataInterface
{
    public function getData(string $content): District
    {
        preg_match('/(?<=\<p\>Powierzchnia dzielnicy: \<strong\>)\d*,\d*(?= ha)/u', $content, $areaArray);
        preg_match('/(?<=\<strong\>)\s?\d*(?=\<\/strong>\<\/p\>)/u', $content, $populationArray);
        preg_match('/(?<=\<h1 class="bip"\>Dzielnica ).*(?=\<\/h1\>)/u', $content, $rowName);
        try {
            $area = str_replace(',', '.', $areaArray[0]);
            $population = $populationArray[0];
            $name = '';
            $nameArray = explode(' ', $rowName[0]);
            $count = count($nameArray);
            foreach ($nameArray as $key => $iValue) {
                if ($key !== 0) {
                    $name .= $iValue;
                }
                if ($key > 0 && $key !== $count - 1) {
                    $name .= ' ';
                }
            }
        } catch (\Exception $e) {
            throw new FetchDataException();
        }

        $city = 'Kraków';

        return new District($city, $name, (float)trim($area), (int)$population);
    }
}