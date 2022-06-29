<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DistrictRepository")
 * @ORM\Table=(name="district")
 */
class District
{
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
     * @ORM\Column(length=20, nullable=false)
     */
    private string $name;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=false)
     */
    private float $area;

}