<?php

namespace App\Repository;

use App\Entity\Seminariste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Seminariste>
 *
 * @method Seminariste|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seminariste|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seminariste[]    findAll()
 * @method Seminariste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeminaristeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seminariste::class);
    }

    //    /**
    //     * @return Seminariste[] Returns an array of Seminariste objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Seminariste
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
