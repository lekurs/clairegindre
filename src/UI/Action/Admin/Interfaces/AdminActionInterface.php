<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 11:23
 */

namespace App\UI\Action\Admin\Interfaces;


use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Domain\Repository\Interfaces\BenefitRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\MailRepositoryInterface;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\AddArticleTypeHandlerInterface;
use App\UI\Form\FormHandler\Interfaces\AddBenefitHandlerInterface;
use App\UI\Form\FormHandler\Interfaces\RegistrationTypeHandlerInterface;
use App\UI\Responder\Admin\Interfaces\AdminResponderInterface;
use App\UI\Responder\Errors\AuthenticationErrorsResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface AdminActionInterface
{
    /**
     * AdminActionInterface constructor.
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
     * @param AuthenticationErrorsResponder $errorsResponder
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
        UrlGeneratorInterface $urlGenerator,
        AuthenticationErrorsResponder $errorsResponder
    );

    /**
     * @param Request $request
     * @param AdminResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AdminResponderInterface $responder);
}
