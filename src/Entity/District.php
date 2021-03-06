<?php
declare(strict_types=1);

namespace App\Entity;

use App\Services\DistrictFilter;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DistrictRepository")
 * @ORM\Table=(name="district")
 */
class District
{
    public const ID_KEY = 'id';
    public const NAME_KEY = 'name';
    public const CITY_KEY = 'city';
    public const AREA_KEY = 'area';
    public const POPULATION_KEY = 'population';
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(length=20, nullable=false)
     */
    private string $city;

    /**
     * @var string
     *
     * @ORM\Column(length=255, nullable=false)
     */
    private string $name;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=false)
     */
    private float $area;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private int $population;

    /**
     * @param string $city
     * @param string $name
     * @param float $area
     * @param int $population
     */
    public function __construct(string $city, string $name, float $area, int $population)
    {
        $this->city = $city;
        $this->name = $name;
        $this->area = $area;
        $this->population = $population;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getArea(): float
    {
        return $this->area;
    }

    /**
     * @return int
     */
    public function getPopulation(): int
    {
        return $this->population;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param float $area
     */
    public function setArea(float $area): void
    {
        $this->area = $area;
    }

    /**
     * @param int $population
     */
    public function setPopulation(int $population): void
    {
        $this->population = $population;
    }

    public function toArray(): array
    {
        return [
            self::CITY_KEY => $this->city,
            self::NAME_KEY => $this->name,
            self::AREA_KEY => $this->area,
            self::POPULATION_KEY => $this->population
        ];
    }

    public function equals(District $district): bool
    {
        return $this->name === $district->getName() &&
            $this->city === $district->getCity() &&
            $this->area === $district->getArea() &&
            $this->population === $district->getPopulation();
    }

}