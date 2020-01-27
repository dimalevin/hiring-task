<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Project::class);
    }

    /**
     * @return Project[]
     */
    public function findAllProjectsOrdered()
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        $queryBuilder
            ->select('p')
            ->from(Project::class, 'p')
            ->addOrderBy('p.name', 'asc')
            //->addOrderBy('p.status', 'asc')
        ;

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @return int[]
     */
    public function getAllIds(): array
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        $queryBuilder
            ->select('p.id')
            ->from(Project::class, 'p')
        ;

        return $queryBuilder->getQuery()->getResult('COLUMN_HYDRATOR_INT');
    }

    /**
     * @param string $search
     *
     * @return Project[]|array
     */
    public function autocomplete(string $search): array
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        $queryBuilder
            ->select('p')
            ->from(Project::class, 'p')
            ->where($queryBuilder->expr()->like(
                'p.name',
                $queryBuilder->expr()->literal('%'.$search.'%')
            ))
            ->addOrderBy('p.name')
            ->addOrderBy('p.totalEmployees', 'desc')
        ;

        return $queryBuilder->getQuery()->getResult();
    }

    // /**
    //  * @return Project[] Returns an array of Project objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Project
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
