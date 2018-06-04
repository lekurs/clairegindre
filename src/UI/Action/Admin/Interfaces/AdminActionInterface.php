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
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\AddArticleTypeHandlerInterface;
use App\UI\Form\FormHandler\Interfaces\AddBenefitHandlerInterface;
use App\UI\Form\FormHandler\Interfaces\RegistrationTypeHandlerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface AdminActionInterface
{
    /**
     * AdminAction constructor.
     *
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param GalleryRepositoryInterface $galleryRepository
     * @param UserRepositoryInterface $userRepository
     * @param BenefitRepositoryInterface $benefitRepository
     * @param ArticleRepositoryInterface $articleRepository
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
        FormFactoryInterface $formFactory,
        RegistrationTypeHandlerInterface $registrationTypeHandler,
        AddArticleTypeHandlerInterface $addArticleTypeHandler,
        AddBenefitHandlerInterface $addBenefitTypeHandler,
        UrlGeneratorInterface $urlGenerator
    );
}
