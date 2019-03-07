<?php

namespace App\Repository;

use App\Entity\NoteItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NoteItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method NoteItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method NoteItem[]    findAll()
 * @method NoteItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteItemRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NoteItem::class);
    }

    // /**
    //  * @return NoteItem[] Returns an array of NoteItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NoteItem
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
