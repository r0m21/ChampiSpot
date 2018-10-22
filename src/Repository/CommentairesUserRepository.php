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

    /* public function findComment($id){
        $conn = $this->getEntityManager()->getConnection();               
                $sql = 'SELECT * FROM commentaires_user
                        WHERE com_id_spot_id = :id
                        LIMIT 3';
                $stmt = $conn->prepare($sql);

                $stmt->bindValue(':id', $id);
                $stmt->execute();
            } */

    /* public function findComment($id)
    {
        return $this->createQueryBuilder()
            ->andWhere('com_id_spot_id = :id')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    } */
}
