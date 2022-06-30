<?php

namespace App\Repository;

use App\Entity\District;
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

    public function filter(array $parameters): array
    {
        $qb = $this->createQueryBuilder('d')
            ->where(':column LIKE :userText')
            ->orderBy('id', 'asc')
            ->setParameters(
                [
                    'column' => $parameters['filterColumn'],
                    'userText' => $parameters['filter'],
                    'orderColumn' => $parameters['sortColumn'],
                    'order' => $parameters['sortDirection']
                ]
            )
            ->getQuery();


            $qb->getResult();
    }
}