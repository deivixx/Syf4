<?php

namespace App\Repository;

use App\Entity\Note;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Note|null find($id, $lockMode = null, $lockVersion = null)
 * @method Note|null findOneBy(array $criteria, array $orderBy = null)
 * @method Note[]    findAll()
 * @method Note[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Note::class);
    }

    public function findWithDueDate() {
        $qb = $this->createQueryBuilder('n');
        return $qb->where($qb->expr()->isNotNull('n.dueDate'))
                        ->getQuery()
                        ->getResult();
    }

    public function findWithoutDueDate() {
        $qb = $this->createQueryBuilder('n');
        return $qb->where($qb->expr()->isNull('n.dueDate'))
                        ->setMaxResults(1)
                        ->getQuery()
                        ->getResult();
    }

    public function findCustomByTitle($title) {
        return $this->createQueryBuilder('n')
                        ->andWhere('n.title = :val')
                        ->setParameter('val', $title)
                        ->orderBy('n.id', 'ASC')
                        ->setMaxResults(10)
                        ->getQuery()
                        ->getResult()
        ;
    }

    public function findLikeTitle($val) {

        $qb = $this->createQueryBuilder('n');
        return $this->createQueryBuilder('n')
                        ->Where($qb->expr()->like('n.title', ':val'))
                        ->setParameter('val', "%$val%")
                        ->getQuery()
                        ->getResult()
        ;
    }

    public function findDQL($note) {

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
                        'SELECT n
        FROM App\Entity\Note n
        WHERE n.note like :note
        ORDER BY n.title ASC'
                )->setParameter('note', "%$note%");

        return $query->execute();
    }

    public function findSQL($note) {
        
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM note n
                WHERE n.note like :note
            ORDER BY n.title ASC';
        
        $stmt = $conn->prepare($sql);
        $stmt->execute(['note' => "%$note%"]);

        
        return $stmt->fetchAll();
    }

    // /**
    //  * @return Note[] Returns an array of Note objects
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
      public function findOneBySomeField($value): ?Note
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
