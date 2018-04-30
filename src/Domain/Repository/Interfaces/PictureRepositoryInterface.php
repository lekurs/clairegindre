<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 11:14
 */

namespace App\Domain\Repository\Interfaces;


use App\Domain\Models\Interfaces\PictureInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

interface PictureRepositoryInterface
{
    /**
     * PictureRepositoryInterface constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry);

    /**
     * @param PictureInterface $picture
     * @return mixed
     */
    public function save(PictureInterface $picture);

    /**
     * @param PictureInterface $picture
     * @return mixed
     */
    public function delete(PictureInterface $picture);
}