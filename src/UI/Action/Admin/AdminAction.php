<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 11:23
 */

namespace App\UI\Action\Admin;

use App\Domain\DTO\GallerySessionDTO;
use App\Domain\Form\Type\AddArticleType;
use App\Domain\Form\Type\AddBenefitType;
use App\Domain\Form\Type\RegistrationType;
use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Domain\Repository\Interfaces\BenefitRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Action\Admin\Interfaces\AdminActionInterface;
use App\UI\Form\FormHandler\Interfaces\AddArticleTypeHandlerInterface;
use App\UI\Form\FormHandler\Interfaces\AddBenefitHandlerInterface;
use App\UI\Form\FormHandler\Interfaces\RegistrationTypeHandlerInterface;
use App\UI\Responder\Admin\Interfaces\AdminResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var BenefitRepositoryInterface
     */
    private $benefitRepository;

    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

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
     * @var SessionInterface
     */
    private $session;

    /**
     * AdminAction constructor.
     *
     * @param TokenStorageInterface $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param GalleryRepositoryInterface $galleryRepository
     * @param UserRepositoryInterface $userRepository
     * @param BenefitRepositoryInterface $benefitRepository
     * @param ArticleRepositoryInterface $articleRepository
     * @param FormFactoryInterface $formFactory
     * @param RegistrationTypeHandlerInterface $registrationTypeHandler
     * @param AddArticleTypeHandlerInterface $addArticleTypeHandler
     * @param AddBenefitHandlerInterface $addBenefitTypeHandler
     * @param SessionInterface $session
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker,
        GalleryRepositoryInterface $galleryRepository,
        UserRepositoryInterface $userRepository,
        BenefitRepositoryInterface $benefitRepository,
        ArticleRepositoryInterface $articleRepository,
        FormFactoryInterface $formFactory,
        RegistrationTypeHandlerInterface $registrationTypeHandler,
        AddArticleTypeHandlerInterface $addArticleTypeHandler,
        AddBenefitHandlerInterface $addBenefitTypeHandler,
        SessionInterface $session = null
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
        $this->galleryRepository = $galleryRepository;
        $this->userRepository = $userRepository;
        $this->benefitRepository = $benefitRepository;
        $this->articleRepository = $articleRepository;
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
        if(false === $this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Merci de vous connecter comme Administrateur sur ce site !');
        }

        $users = $this->userRepository->showGalleryByUser();

        $galleries = $this->galleryRepository->getAllWithPictures();

        $benefits = $this->benefitRepository->getAll();

        $articles = $this->articleRepository->findAll();

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

            $galleryDTO = new GallerySessionDTO($request->request->get('add_article')['gallery']);

            $this->session->set('gallery', $galleryDTO);

            return $responder(true, $registration, $benefitsType, $addArticleType, $users, $galleries, $benefits, $articles, 'adminAddArticleSelectPictures');
        }

        return $responder(false, $registration, $benefitsType, $addArticleType, $users, $galleries, $benefits, $articles);
    }
}
