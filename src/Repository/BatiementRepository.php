<?php

namespace App\Repository;

use App\Entity\Batiement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Batiement>
 *
 * @method Batiement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Batiement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Batiement[]    findAll()
 * @method Batiement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BatiementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Batiement::class);
    }

    //    /**
    //     * @return Batiement[] Returns an array of Batiement objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Batiement
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
