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

final class BenefitRepository extends ServiceEntityRepository implements BenefitRepositoryInterface
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
        return $this->createQueryBuilder('benefit')
            ->orderBy('benefit.id')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param $id
     * @return array
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOne($id)
    {
        return $this->createQueryBuilder('benefit')
            ->where('benefit.id= :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
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

    public function edit(BenefitInterface $benefit): void
    {
        $this->getEntityManager()->flush();
    }
}
