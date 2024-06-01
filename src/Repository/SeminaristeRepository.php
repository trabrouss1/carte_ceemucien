<?php

namespace App\Repository;

use App\Entity\Seminariste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;

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
    public function __construct(ManagerRegistry $registry, private PaginatorInterface $paginator)
    {
        parent::__construct($registry, Seminariste::class);
    }

    public function allSeminaristes(int $anneeId, int $page = 1)
    {
        $qb = $this->createQueryBuilder('s')
            ->join('s.seminaire', 'se')
            ->andWhere('se.annee = :anneeId')
            ->setParameter('anneeId', $anneeId)
            ->orderBy('s.id', 'DESC');
        return $this->paginator->paginate(
            $qb,
            $page,
            20,
            [
                'distinct' => false
            ]
        );
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
