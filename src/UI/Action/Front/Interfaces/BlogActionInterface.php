<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/04/2018
 * Time: 17:36
 */

namespace App\UI\Action\Front\Interfaces;


use App\Domain\Builder\Interfaces\ArticleBuilderInterface;
use App\Domain\Lib\InstagramLib;
use App\Domain\Repository\Interfaces\BenefitRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\UI\Responder\Interfaces\BlogResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface BlogActionInterface
{
    /**
     * BlogActionInterface constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param GalleryRepositoryInterface $galleryRepository
     * @param BenefitRepositoryInterface $benefitRepository
     * @param InstagramLib $instagram
     * @param ArticleBuilderInterface $articleBuilder
     * @param ReviewsRepositoryInterface $reviewsRepository
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        GalleryRepositoryInterface $galleryRepository,
        BenefitRepositoryInterface $benefitRepository,
        InstagramLib $instagram,
        ArticleBuilderInterface $articleBuilder,
        ReviewsRepositoryInterface $reviewsRepository
    );

    /**
     * @param Request $request
     * @param BlogResponderInterface $response
     * @return mixed
     */
    public function __invoke(Request $request, BlogResponderInterface $response);
}
