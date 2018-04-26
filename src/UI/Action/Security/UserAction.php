<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 16:51
 */

namespace App\UI\Action\Security;


use App\Domain\Form\Type\AddGalleryType;
use App\Domain\Models\User;
use App\UI\Action\Security\Interfaces\UserActionInterface;
use App\UI\Form\FormHandler\Interfaces\AddGalleryTypeHandlerInterface;
use App\UI\Responder\Security\Interfaces\UserResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserAction
 *
 * @Route(
 *     name="adminUser",
 *     path="admin/users",
 *     methods={"GET"}
 * )
 *
 * @package App\UI\Action\Security
 */
class UserAction implements UserActionInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AddGalleryTypeHandlerInterface
     */
    private $addGalleryTypeHandler;

    /**
     * UserAction constructor.
     * @param EntityManagerInterface $entityManager
     * @param FormFactoryInterface $formFactory
     * @param AddGalleryTypeHandlerInterface $addGalleryTypeHandler
     */
    public function __construct(EntityManagerInterface $entityManager, FormFactoryInterface $formFactory, AddGalleryTypeHandlerInterface $addGalleryTypeHandler)
    {
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
        $this->addGalleryTypeHandler = $addGalleryTypeHandler;
    }


    public function __invoke(Request $request, UserResponderInterface $responder)
    {
        $users = $this->entityManager->getRepository(User::class)->showGalleryByUser();

        $form = $this->formFactory->create(AddGalleryType::class);

        return $responder(false, $form, $users);
    }

}