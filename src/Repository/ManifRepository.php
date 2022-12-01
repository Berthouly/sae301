<?php

namespace App\Repository;

use App\Entity\Manif;
use App\Entity\Salle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Manif>
 *
 * @method Manif|null find($id, $lockMode = null, $lockVersion = null)
 * @method Manif|null findOneBy(array $criteria, array $orderBy = null)
 * @method Manif[]    findAll()
 * @method Manif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ManifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Manif::class);
    }

    public function save(Manif $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Manif $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }



//    /**
//     * @return Manif[] Returns an array of Manif objects
//     */
    public function searchManif($dataform): array
    {
        return $this->createQueryBuilder('m')
            ->innerJoin(Salle::class, 's', 'WITH', 'm.Salle=s.id')
            ->where('s.nom = :search')
            ->setParameter('search', $dataform)
            ->orderBy('m.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Manif
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
