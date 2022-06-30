<?php
declare(strict_types=1);

namespace App\Services;

use App\Entity\District;

class GetDistrictDataService
{
    private string $content;

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
    public function getData(): District
    {
        preg_match('/(?<=\<p\>Powierzchnia dzielnicy: \<strong\>)\d*,\d*(?= ha\<\/strong>\<\/p\>)/u', $this->content, $areaArray);
        preg_match('/(?<=\<p\>Liczba mieszkańców \(pobyt stały na dzień 31.12.2021\): \<strong\>)\d*(?=\<\/strong>\<\/p\>)/u', $this->content, $populationArray);
        preg_match('/(?<=\<h1 class="bip"\>Dzielnica ).*(?=\<\/h1\>)/u', $this->content, $rowName);
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

        return new District($city, $name, $area, $population);
    }
}