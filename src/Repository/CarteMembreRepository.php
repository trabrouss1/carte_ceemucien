<?php

namespace App\Repository;

use App\Entity\CarteMembre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarteMembre>
 *
 * @method CarteMembre|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteMembre|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteMembre[]    findAll()
 * @method CarteMembre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteMembreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteMembre::class);
    }

    //    /**
    //     * @return CarteMembre[] Returns an array of CarteMembre objects
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

    //    public function findOneBySomeField($value): ?CarteMembre
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
