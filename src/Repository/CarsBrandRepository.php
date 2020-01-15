<?php

namespace App\Repository;

use App\Entity\CarsBrand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CarsBrand|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarsBrand|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarsBrand[]    findAll()
 * @method CarsBrand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarsBrandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarsBrand::class);
    }

    // /**
    //  * @return CarsBrand[] Returns an array of CarsBrand objects
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
    public function findOneBySomeField($value): ?CarsBrand
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
