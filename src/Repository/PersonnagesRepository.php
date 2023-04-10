<?php

namespace App\Repository;

use App\Entity\Personnages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Personnages>
 *
 * @method Personnages|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personnages|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personnages[]    findAll()
 * @method Personnages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personnages::class);
    }

    public function add(Personnages $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Personnages $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // création d'une méthode pour la barre de recherche
    /**
     * Recherche les personnages en fonction du formulaire
     *
     * @return void
     */
    public function search($mots) {
        $query = $this->createQueryBuilder('p');
        
        // il faut que $mots ne soit pas nul
        // la query telle qu'elle est documentée par Doctrine
        if($mots != null) {
            $query->where('MATCH_AGAINST(p.prenom, p.nom, p.surnom) AGAINST (:mots boolean)>0')
                  ->setParameter('mots', $mots);
        }

        return $query->getQuery()->getResult();
    }

//    /**
//     * @return Personnages[] Returns an array of Personnages objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Personnages
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
