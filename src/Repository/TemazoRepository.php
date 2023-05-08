<?php

namespace App\Repository;

use App\Entity\Temazo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Temazo>
 *
 * @method Temazo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Temazo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Temazo[]    findAll()
 * @method Temazo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TemazoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Temazo::class);
    }

    public function save(Temazo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Temazo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByTitle($value): array
       {
           return $this->createQueryBuilder('t')
          // ->join('s.tratamiento1', 't')
           ->andWhere('t.titulo like :val')
           ->setParameter('val', '%'.$value.'%')
           ->orderBy('t.autor', 'DESC')
           ->setMaxResults(10)
           ->getQuery()
           ->getResult()
            ;
    }



    //findSongByAuthor
public function findSongByAuth($value): array
{
    return $this->createQueryBuilder('t')
    
    ->andWhere('t.autor like :val')
    ->setParameter('val', '%'.$value.'%')
    ->orderBy('t.autor', 'DESC')
    ->setMaxResults(10)
    ->getQuery()
    ->getResult()
     ;
}
//Find by Title y author 

public function findByTitleAuthor($value): array
{
//SELECT * FROM `temazo` WHERE temazo.titulo like ('%Mr%') or temazo.autor like ('%Oz%');
    return $this->createQueryBuilder('t')
     -> where('t.titulo like :val or t.autor like :val')
     ->setParameter('val', '%'.$value.'%')
     ->orderBy('t.autor', 'DESC')
     ->setMaxResults(10)
     ->getQuery()
     ->getResult()
      
;

}

public function findMytTemazos(): array
{   
    return $this->createQueryBuilder('e')
    ->orderBy('e.id', 'DESC')
    ->getQuery()
    ->getResult();
    ;
}



//    /**
//     * @return Temazo[] Returns an array of Temazo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Temazo
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
