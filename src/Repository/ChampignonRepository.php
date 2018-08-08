<?php

namespace App\Repository;

use App\Entity\Champignon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Champignon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Champignon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Champignon[]    findAll()
 * @method Champignon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChampignonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Champignon::class);
    }

//    /**
//     * @return Champignon[] Returns an array of Champignon objects
//     */
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
    public function findOneBySomeField($value): ?Champignon
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
