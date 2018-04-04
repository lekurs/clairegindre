<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 30/03/2018
 * Time: 11:04
 */

namespace App\Controller\InterfacesController\Gallery;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Repository\RepositoryFactory;
use Twig\Environment;

interface GalleryControllerInterface
{
    public function __construct(Environment $twig, EntityManagerInterface $entityManager);

    public function __invoke();
}