<?php

namespace App\Repository;

use App\Entity\Coordination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Coordination>
 *
 * @method Coordination|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coordination|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coordination[]    findAll()
 * @method Coordination[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoordinationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coordination::class);
    }

    //    /**
    //     * @return Coordination[] Returns an array of Coordination objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Coordination
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
