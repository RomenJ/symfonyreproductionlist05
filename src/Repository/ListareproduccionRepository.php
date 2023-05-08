<?php

namespace App\Repository;

use App\Entity\Listareproduccion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Listareproduccion>
 *
 * @method Listareproduccion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Listareproduccion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Listareproduccion[]    findAll()
 * @method Listareproduccion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListareproduccionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Listareproduccion::class);
    }

    public function save(Listareproduccion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Listareproduccion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findByUser($value): array
        {

   
        return $this->createQueryBuilder('l')

         ->andWhere('l.user = :val')
         ->setParameter('val', $value)
         ->orderBy('l.id', 'ASC')
         ->setMaxResults(10)
         ->getQuery()
         ->getResult()
     ;


       }

 public function findByUserEj1($value): array
       {

        /*
        SELECT COUNT(temazo_id) FROM `listareproduccion_temazo` WHERE listareproduccion_id=8
        */ 

        
           return $this->createQueryBuilder('l')
              ->andWhere('l.user = :val')
           //   ->join('l.canciones', 'c')
             // ->select('(sum(c.duracion)) as duraciontotal')
          //    ->select('count(l.canciones)) as conteo')
               ->setParameter('val', $value)
               ->orderBy('l.id', 'ASC')
              ->setMaxResults(10)
              ->getQuery()
              ->getResult()
           ;
      }


      public function findMyListas($value): array
      {   
          return $this->createQueryBuilder('e')
            ->andWhere('e.user = :val')
          ->setParameter('val', $value)
          ->orderBy('e.id', 'DESC')
          ->getQuery()
          ->getResult();
          ;
      }



//    /**
//     * @return Listareproduccion[] Returns an array of Listareproduccion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Listareproduccion
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
