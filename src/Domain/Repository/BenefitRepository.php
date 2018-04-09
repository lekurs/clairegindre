<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 21:13
 */

namespace App\Domain\Repository;

use App\Domain\Repository\Interfaces\BenefitRepositoryInterface;
use App\Domain\Models\Benefit;
use App\Domain\Models\Interfaces\BenefitInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class BenefitRepository extends ServiceEntityRepository implements BenefitRepositoryInterface
{
    /**
     * BenefitRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Benefit::class);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $qb = $this->createQueryBuilder('benefit')
            ->select('benefit.name')
            ->orderBy('benefit.id')
            ->getQuery()
        ;

        return $qb->execute();
    }

    /**
     * @param $id
     * @return array
     */
    public function getOne($id): array
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b.name')
            ->where('id='.$id)
            ->getQuery()
        ;

        return $qb->execute();
    }

    /**
     * @param BenefitInterface $benefit
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(BenefitInterface $benefit): void
    {
        $this->getEntityManager()->persist($benefit);
        $this->getEntityManager()->flush();
    }
}