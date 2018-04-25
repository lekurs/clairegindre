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
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var InstagramLib
     */
    private $instagram;

    /**
     * @var ArticleBuilderInterface
     */
    private $articleBuilder;

    /**
     * BlogAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $entityManager
     * @param InstagramLib $instagram
     * @param ArticleBuilderInterface $articleBuilder
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        InstagramLib $instagram,
        ArticleBuilderInterface $articleBuilder
    ) {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->instagram = $instagram;
        $this->articleBuilder = $articleBuilder;
    }


    public function __invoke(Request $request, BlogResponderInterface $response)
    {
        $contact = $this->formFactory->create(ContactType::class)->handleRequest($request);

        $insta = $this->instagram->show();

        $articles = $this->entityManager->getRepository(Article::class)->getArticlesWithFavoritePictureGallery();

//        dump($articles);

        $benefits = $this->entityManager->getRepository(Benefit::class)->findAll();

        return $response($contact, $insta, $articles, $benefits);
    }
}