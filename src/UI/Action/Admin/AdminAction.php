<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 11:23
 */

namespace App\UI\Action\Admin;


use App\Domain\Form\Type\AddArticleType;
use App\Domain\Form\Type\AddBenefitType;
use App\Domain\Form\Type\RegistrationType;
use App\Domain\Models\Article;
use App\Domain\Models\Benefit;
use App\Domain\Models\Gallery;
use App\Domain\Models\User;
use App\UI\Action\Admin\Interfaces\AdminActionInterface;
use App\UI\Form\FormHandler\Interfaces\AddArticleTypeHandlerInterface;
use App\UI\Form\FormHandler\Interfaces\AddBenefitHandlerInterface;
use App\UI\Form\FormHandler\Interfaces\RegistrationTypeHandlerInterface;
use App\UI\Responder\Admin\Interfaces\AdminResponderInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class AdminAction
 *
 * @Route(
 *     name="admin",
 *     path="/admin"
 * )
 *
 * @package App\UI\Action\Admin
 */
class AdminAction implements AdminActionInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var RegistrationTypeHandlerInterface
     */
    private $registrationTypeHandler;

    /**
     * @var AddArticleTypeHandlerInterface
     */
    private $addArticleTypeHandler;

    /**
     * @var AddBenefitHandlerInterface
     */
    private $addBenefitTypeHandler;

    /**
     * @var Session
     */
    private $session;

    /**
     * AdminAction constructor.
     *
     * @param TokenStorageInterface $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param EntityManagerInterface $entityManager
     * @param FormFactoryInterface $formFactory
     * @param RegistrationTypeHandlerInterface $registrationTypeHandler
     * @param AddArticleTypeHandlerInterface $addArticleTypeHandler
     * @param AddBenefitHandlerInterface $addBenefitTypeHandler
     * @param Session $session
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker,
        EntityManagerInterface $entityManager,
        FormFactoryInterface $formFactory,
        RegistrationTypeHandlerInterface $registrationTypeHandler,
        AddArticleTypeHandlerInterface $addArticleTypeHandler,
        AddBenefitHandlerInterface $addBenefitTypeHandler,
        Session $session
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
        $this->registrationTypeHandler = $registrationTypeHandler;
        $this->addArticleTypeHandler = $addArticleTypeHandler;
        $this->addBenefitTypeHandler = $addBenefitTypeHandler;
        $this->session = $session;
    }


    /**
     * @param AdminResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AdminResponderInterface $responder)
    {
//        if(false === $this->authorizationChecker->isGranted('ROLE_ADMIN')) {
//            throw new AccessDeniedException('pas accès !');
//        }

        $users = $this->entityManager->getRepository(User::class)->showGalleryByUser();

        $galleries = $this->entityManager->getRepository(Gallery::class)->getAllWithPictures();

        $benefits = $this->entityManager->getRepository(Benefit::class)->findAll();

        $articles = $this->entityManager->getRepository(Article::class)->findAll();

        $registration = $this->formFactory->create(RegistrationType::class)->handleRequest($request);

        $benefitsType = $this->formFactory->create(AddBenefitType::class)->handleRequest($request);

        $addArticleType = $this->formFactory->create(AddArticleType::class)->handleRequest($request);

        if ($this->registrationTypeHandler->handle($registration)) {

            return $responder(true, $registration, $benefitsType, $addArticleType, $users, $galleries, $benefits, $articles);
        }

        if ($this->addBenefitTypeHandler->handle($benefitsType)) {

            return $responder(true, $registration, $benefitsType, $addArticleType,  $users, $galleries, $benefits, $articles);
        }

        if ($this->addArticleTypeHandler->handle($addArticleType)) {

            $this->session->set('gallery', $request->request->get('add_article'));

            return $responder(true, $registration, $benefitsType, $addArticleType, $users, $galleries, $benefits, $articles, 'adminAddArticleSelectPictures');
        }

        return $responder(false, $registration, $benefitsType, $addArticleType, $users, $galleries, $benefits, $articles);
    }
}
