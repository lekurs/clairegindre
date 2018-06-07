<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 16:54
 */

namespace App\Domain\Repository;


use App\Domain\Models\Mail;
use App\Domain\Repository\Interfaces\MailRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

final class MailRepository extends ServiceEntityRepository implements MailRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mail::class);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->createQueryBuilder('mail')
                                ->getQuery()
                                ->getResult();
    }

    /**
     * @return mixed
     */
    public function getAllNotAnswer()
    {
        return $this->createQueryBuilder('mail')
                            ->where('mail.isAnswered = 0')
                            ->getQuery()
                            ->getResult();
    }

    /**
     * @param $slug
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOneBySlug($slug)
    {
        return $this->createQueryBuilder('mail')
                            ->where('mail.slug = :slug')
                            ->setParameter('slug', $slug)
                            ->getQuery()
                            ->getOneOrNullResult();
    }

    /**
     * @param Mail $mail
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Mail $mail):void
    {
        $this->getEntityManager()->persist($mail);
        $this->getEntityManager()->flush();
    }

    public function update(Mail $mail):void
    {
        $mail->mailRead();
        $this->getEntityManager()->flush();
    }
}