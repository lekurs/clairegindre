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
use App\Domain\Form\Type\SelectGalleryForArticleType;
use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Domain\Repository\Interfaces\BenefitRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\MailRepositoryInterface;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Action\Admin\Interfaces\AdminActionInterface;
use App\UI\Form\FormHandler\Interfaces\AddArticleTypeHandlerInterface;
use App\UI\Form\FormHandler\Interfaces\AddBenefitHandlerInterface;
use App\UI\Form\FormHandler\Interfaces\RegistrationTypeHandlerInterface;
use App\UI\Form\FormHandler\SelectGalleryTypeHandler;
use App\UI\Responder\Admin\Interfaces\AdminResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
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
final class AdminAction implements AdminActionInterface
{
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
     * @var MailRepositoryInterface
     */
    private $mailRepository;

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
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * AdminAction constructor.
     *
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param GalleryRepositoryInterface $galleryRepository
     * @param UserRepositoryInterface $userRepository
     * @param BenefitRepositoryInterface $benefitRepository
     * @param ArticleRepositoryInterface $articleRepository
     * @param MailRepositoryInterface $mailRepository
     * @param FormFactoryInterface $formFactory
     * @param RegistrationTypeHandlerInterface $registrationTypeHandler
     * @param AddArticleTypeHandlerInterface $addArticleTypeHandler
     * @param AddBenefitHandlerInterface $addBenefitTypeHandler
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        AuthorizationCheckerInterface $authorizationChecker,
        GalleryRepositoryInterface $galleryRepository,
        UserRepositoryInterface $userRepository,
        BenefitRepositoryInterface $benefitRepository,
        ArticleRepositoryInterface $articleRepository,
        MailRepositoryInterface $mailRepository,
        FormFactoryInterface $formFactory,
        RegistrationTypeHandlerInterface $registrationTypeHandler,
        AddArticleTypeHandlerInterface $addArticleTypeHandler,
        AddBenefitHandlerInterface $addBenefitTypeHandler,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->authorizationChecker = $authorizationChecker;
        $this->galleryRepository = $galleryRepository;
        $this->userRepository = $userRepository;
        $this->benefitRepository = $benefitRepository;
        $this->articleRepository = $articleRepository;
        $this->mailRepository = $mailRepository;
        $this->formFactory = $formFactory;
        $this->registrationTypeHandler = $registrationTypeHandler;
        $this->addArticleTypeHandler = $addArticleTypeHandler;
        $this->addBenefitTypeHandler = $addBenefitTypeHandler;
        $this->urlGenerator = $urlGenerator;
    }


    /**
     * @param Request $request
     * @param AdminResponderInterface $responder
     * @return mixed|RedirectResponse
     */
    public function __invoke(Request $request, AdminResponderInterface $responder)
    {
//        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {

            $users = $this->userRepository->showAll();

            $galleries = $this->galleryRepository->getAll();

            $benefits = $this->benefitRepository->getAll();

            $articles = $this->articleRepository->getAll();

            $mails = $this->mailRepository->getAllNotAnswer();

            $registration = $this->formFactory->create(RegistrationType::class)->handleRequest($request);

            $benefitsType = $this->formFactory->create(AddBenefitType::class)->handleRequest($request);

            $selectArticle = $this->formFactory->create(SelectGalleryForArticleType::class)->handleRequest($request);

            if ($this->registrationTypeHandler->handle($registration)) {

                return $responder(true, $registration, $benefitsType, $selectArticle, $users, $galleries, $benefits, $articles, $mails);
            }

            if ($this->addBenefitTypeHandler->handle($benefitsType)) {

                return $responder(true, $registration, $benefitsType, $selectArticle,  $users, $galleries, $benefits, $articles, $mails);
            }

            if ($selectArticle->isSubmitted() && $selectArticle->isValid()) {

                return new RedirectResponse($this->urlGenerator->generate('adminAddArticle', ['slug' => $selectArticle->getData()['title']->getSlug()]));
            }

            return $responder(false, $registration, $benefitsType, $selectArticle, $users, $galleries, $benefits, $articles, $mails);
        }
//    }
}
