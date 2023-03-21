<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function save(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllByMinPrice()
    {
        return $this->createQueryBuilder('a')
            ->where('a.prix > :prixMin')
            ->setParameter('prixMin', '10')
            ->getQuery()
            ->getResult();
    }

    public function findAllByMinPriceAndName()
    {
        return $this->createQueryBuilder('a')
            ->where('a.prix > :prixMin')
            ->andWhere('a.designation LIKE :designation')
            ->setParameters(['prixMin'=>'10', 'designation'=>'%hel%'])
            ->getQuery()
            ->getResult();
    }

    public function findAllByMinPriceNameAndCp()
    {
        return $this->createQueryBuilder('a')
            ->join('a.fournisseur', 'f')
            ->join('f.adresse', 'b')
            ->where('a.prix > :prixMin')
            ->andWhere('a.designation LIKE :designation')
            ->andWhere('b.codePostal = 12345')
            ->setParameters(['prixMin'=>'10', 'designation'=>'%hel%'])
            ->getQuery()
            ->getResult();
    }


//    /**
//     * @return Article[] Returns an array of Article objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->getQuery()
//            ->setMaxResults(10)
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
