<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/02/2018
 * Time: 22:09
 */

namespace App\Controller\Security;


use App\Builder\Interfaces\GalleryBuilderInterface;
use App\Builder\Interfaces\UserBuilderInterface;
use App\Controller\InterfacesController\Admin\UserControllerInterface;
use App\Entity\Benefit;
use App\Entity\Gallery;
use App\Entity\User;
use App\Repository\BenefitRepository;
use App\Type\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class UserController implements UserControllerInterface
{
    /**
     * @var Environment
     */
    private $twig;


    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UserBuilderInterface
     */
    private $userBuilder;

    /**
     * @var GalleryBuilderInterface
     */
    private $galleryBuilder;

    /**
     * UserController constructor.
     * @param Environment $twig
     * @param EntityManagerInterface $entityManager
     * @param UserBuilderInterface $userBuilder
     * @param GalleryBuilderInterface $galleryBuilder
     */
    public function __construct(
        Environment $twig,
        EntityManagerInterface $entityManager,
        UserBuilderInterface $userBuilder,
        GalleryBuilderInterface $galleryBuilder
    ) {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->userBuilder = $userBuilder;
        $this->galleryBuilder = $galleryBuilder;
    }


    /**
     * @Route(name="adminUsers", path="admin/users", methods={"GET"})
     * @param Request $request
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request)
    {
        $users = $this->entityManager->getRepository(User::class)
            ->showAll();

        $galleriesByUser = $this->entityManager->getRepository(Gallery::class)->showGalleryByUser();

        return new Response($this->twig->render('back/admin/users.html.twig', array(
            'users' => $users,
            'galleriesByUser' => $galleriesByUser
        )));
    }
}
