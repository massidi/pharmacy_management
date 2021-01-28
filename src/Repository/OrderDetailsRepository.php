<?php

namespace App\Repository;

use App\Entity\OrderDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrderDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderDetails[]    findAll()
 * @method OrderDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderDetails::class);
    }

    public function findByMonth()
    {
        $date = new \DateTime();
//        $from = new \DateTime($date->format("Y-m-d")." 00:00:00");
//        $to   = new \DateTime($date->format("Y-m")." 23:59:59");

        $from = new \DateTime('first day of this month');
        $to   = new \DateTime('last day of this month');


        $qb = $this->createQueryBuilder('o')

                    ->andWhere('o.createdAt  BETWEEN :from AND :to')
                    ->setParameter('from', $from )
                    ->setParameter('to', $to)
                    ->join('o.client','client')
                    ->addSelect('client')
                ;

                $result = $qb->getQuery()->getResult();

        return $result;
    }
    public function findByDay()
    {
        $from = new \DateTime('yesterday '."00:00:00");
        $to   = new \DateTime('yesterday'."23:59:59");
//dd(new \DateTime('yesterday'));
        $qb = $this->createQueryBuilder('o')

                    ->andWhere('o.createdAt  BETWEEN :from AND :to')
                    ->setParameter('from', $from )
                    ->setParameter('to', $to)
                    ->join('o.client','client')
                    ->addSelect('client')
        ;
//dd( new \DateTime('today'));
        $result = $qb->getQuery()->getResult();


        return $result;
    }


    // /**
    //  * @return OrderDetails[] Returns an array of OrderDetails objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderDetails
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
