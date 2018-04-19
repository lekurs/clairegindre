<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 19/04/2018
 * Time: 20:02
 */

namespace App\UI\Action\Front;


use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\UI\Action\Front\Interfaces\GalleryCustomerConnectionActionInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GalleryCustomerConnectionAction
 *
 * @Route(
 *     name="galleryCustomerConnection",
 *     path="/galleries/{id}"
 * )
 *
 * @package App\UI\Action\Front
 */
class GalleryCustomerConnectionAction implements GalleryCustomerConnectionActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UserBuilderInterface
     */
    private $userBuilder;

    /**
     * GalleryCustomerConnectionAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $entityManager
     * @param UserBuilderInterface $userBuilder
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        UserBuilderInterface $userBuilder
    ) {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->userBuilder = $userBuilder;
    }

    public function __invoke()
    {
        
    }

}