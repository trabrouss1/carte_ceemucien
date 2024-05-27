<?php

namespace App\Repository;

use App\Entity\Dortoirs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dortoirs>
 *
 * @method Dortoirs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dortoirs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dortoirs[]    findAll()
 * @method Dortoirs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DortoirsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dortoirs::class);
    }

    //    /**
    //     * @return Dortoirs[] Returns an array of Dortoirs objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Dortoirs
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
