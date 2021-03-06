<?php

namespace App\Repository;

use App\Entity\CarModels;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CarModels|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarModels|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarModels[]    findAll()
 * @method CarModels[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarModelsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarModels::class);
    }

    // /**
    //  * @return CarModels[] Returns an array of CarModels objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CarModels
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
