<?php

namespace App\Repository;

use App\Entity\District;
use App\Services\DistrictFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DistrictRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, District::class);
    }
    public function add(District $district): void
    {
        $this->_em->persist($district);
        $this->_em->flush($district);
    }

    public function remove(District $district): void
    {
        $this->_em->remove($district);
        $this->_em->flush($district);
    }

    public function filter(DistrictFilter $districtFilter): array
    {
        $userText = '%' . $districtFilter->getFilter() . '%';

        $qb = $this->createQueryBuilder('d');

        switch ($districtFilter->getFilterColumn()) {

            case 'city':
                $qb->where('d.city LIKE :userText');
                break;
            case 'name':
                $qb->where('d.name LIKE :userText');
                break;
            case 'area':
                $qb->where('d.area LIKE :userText');
                break;
            case 'population':
                $qb->where('d.population LIKE :userText');
                break;
            default:
                $qb->where('d.id LIKE :userText');
                break;
        }
        switch ($districtFilter->getSortColumn()) {
            case 'id':
                $qb->orderBy('d.id', $districtFilter->getSortDirection() === 'desc' ? 'desc' : 'asc');
                break;
            case 'city':
                $qb->orderBy('d.city', $districtFilter->getSortDirection()=== 'desc' ? 'desc' : 'asc');
                break;
            case 'area':
                $qb->orderBy('d.area', $districtFilter->getSortDirection() === 'desc' ? 'desc' : 'asc');
                break;
            case 'population':
                $qb->orderBy('d.population', $districtFilter->getSortDirection() === 'desc' ? 'desc' : 'asc');
                break;
            default:
                $qb->orderBy('d.name', $districtFilter->getSortDirection() === 'desc' ? 'desc' : 'asc');
                break;
        }
            $qb->setParameters(
                [
                    'userText' => $userText,
                ]
            );

            return $qb->getQuery()->getArrayResult();

    }
}