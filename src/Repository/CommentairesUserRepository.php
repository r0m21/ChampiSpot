<?php

namespace App\Repository;

use App\Entity\CommentairesUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CommentairesUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentairesUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentairesUser[]    findAll()
 * @method CommentairesUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentairesUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CommentairesUser::class);
    }

//    /**
//     * @return CommentairesUser[] Returns an array of CommentairesUser objects
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
    public function findOneBySomeField($value): ?CommentairesUser
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
