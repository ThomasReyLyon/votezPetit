<?php

namespace App\Repository;

use App\Entity\Problems;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Problems|null find($id, $lockMode = null, $lockVersion = null)
 * @method Problems|null findOneBy(array $criteria, array $orderBy = null)
 * @method Problems[]    findAll()
 * @method Problems[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProblemsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Problems::class);
    }

    // /**
    //  * @return Problems[] Returns an array of Problems objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Problems
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
