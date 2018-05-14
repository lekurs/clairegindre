<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/04/2018
 * Time: 17:36
 */

namespace App\UI\Action\Front;


use App\Domain\Builder\Interfaces\ArticleBuilderInterface;
use App\Domain\Form\Type\ContactType;
use App\Domain\Lib\InstagramLib;
use App\Domain\Models\Article;
use App\Domain\Models\Benefit;
use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Domain\Repository\Interfaces\BenefitRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\UI\Action\Front\Interfaces\BlogActionInterface;
use App\UI\Form\FormHandler\Interfaces\ContactTypeHandlerInterface;
use App\UI\Responder\Interfaces\BlogResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogAction
 *
 * @Route(
 *     name="blog",
 *     path="blog"
 * )
 *
 * @package App\UI\Action\Front
 */
class BlogAction implements BlogActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var BenefitRepositoryInterface
     */
    private $benefitRepository;

    /**
     * @var InstagramLib
     */
    private $instagram;

    /**
     * @var ArticleBuilderInterface
     */
    private $articleBuilder;

    /**
     * @var ReviewsRepositoryInterface
     */
    private $reviewsRepository;

    /**
     * BlogAction constructor.
     * @param FormFactoryInterface $formFactory
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
    ) {
        $this->formFactory = $formFactory;
        $this->galleryRepository = $galleryRepository;
        $this->benefitRepository = $benefitRepository;
        $this->instagram = $instagram;
        $this->articleBuilder = $articleBuilder;
        $this->reviewsRepository = $reviewsRepository;
    }


    public function __invoke(Request $request, BlogResponderInterface $response)
    {
        $contact = $this->formFactory->create(ContactType::class)->handleRequest($request);

        $insta = $this->instagram->show();

        $galleries = $this->galleryRepository->getAllWithArticle();

        $benefits = $this->benefitRepository->getAll();

        $reviews = $this->reviewsRepository->getAll();

        return $response($contact, $insta, $galleries, $benefits, $reviews);
    }
}