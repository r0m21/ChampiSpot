<?php

namespace App\Repository;

use App\Entity\Spot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Spot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Spot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Spot[]    findAll()
 * @method Spot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpotRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Spot::class);
    }

//    /**
//     * @return Spot[] Returns an array of Spot objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Spot
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findChampisFromAllSpot(){
        $conn = $this->getEntityManager()->getConnection();
        if(isset($_POST['submitFilter'])){
            $espece = $_POST['filter'];
            if($_POST['filter'] != "default"){                
                $sql = '
                SELECT * FROM spot
                INNER JOIN champignon
                WHERE spot.spo_id_champi_id = champignon.id
                AND champignon.cha_espece LIKE :espece                    
                ';
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':espece', $espece);
                $stmt -> execute();
            }
        }
        else{
            $sql = '
            SELECT * FROM spot
            INNER JOIN champignon
            WHERE spot.spo_id_champi_id = champignon.id    
            ';
            $stmt = $conn->prepare($sql);
            $stmt -> execute();
        }


        return $stmt->fetchAll();
    }
}
