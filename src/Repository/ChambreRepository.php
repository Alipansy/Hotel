<?php

namespace App\Repository;

use App\Entity\Chambre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Chambre>
 *
 * @method Chambre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chambre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chambre[]    findAll()
 * @method Chambre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChambreRepository extends ServiceEntityRepository
{
    public static function getEntityFqcn(): string
    {
        return Chambre::class;
    }
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chambre::class);
    }

    public function save(Chambre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Chambre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return Chambre[] Returns an array of Chambre objects
    //     */
    public function simple($value): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.prix <= :val')
            ->setParameter('val', $value)
            ->orderBy('c.prix', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function confort($value): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.prix >= :minPrice')
            ->andWhere('c.prix <= :maxPrice')
            ->setParameter('minPrice', 200)
            ->setParameter('maxPrice', 500)
            ->orderBy('c.prix', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function suite($value): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.prix >= :val')
            ->setParameter('val', $value)
            ->orderBy('c.prix', 'ASC')
            ->getQuery()
            ->getResult();
    }


    //    public function findOneBySomeField($value): ?Chambre
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
