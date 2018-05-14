<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:19
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Builder\Interfaces\ArticleBuilderInterface;
use App\Domain\Repository\Interfaces\ArticleRepositoryInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Services\SlugHelper;
use App\UI\Form\FormHandler\Interfaces\AddArticleTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddArticleTypeHandler implements AddArticleTypeHandlerInterface
{
    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var ArticleBuilderInterface
     */
    private $articleBuilder;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var SlugHelper
     */
    private $stringReplaceHelper;

    /**
     * AddArticleTypeHandler constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     * @param ArticleRepositoryInterface $articleRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param ArticleBuilderInterface $articleBuilder
     * @param TokenStorageInterface $tokenStorage
     * @param SlugHelper $stringReplaceHelper
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        ArticleRepositoryInterface $articleRepository,
        SessionInterface $session,
        ValidatorInterface $validator,
        ArticleBuilderInterface $articleBuilder,
        TokenStorageInterface $tokenStorage,
        SlugHelper $stringReplaceHelper
    ) {
        $this->galleryRepository = $galleryRepository;
        $this->articleRepository = $articleRepository;
        $this->session = $session;
        $this->validator = $validator;
        $this->articleBuilder = $articleBuilder;
        $this->tokenStorage = $tokenStorage;
        $this->stringReplaceHelper = $stringReplaceHelper;
    }

    /**
     * @param FormInterface $form
     * @param $gallery
     * @return bool
     */
    public function handle(FormInterface $form, $gallery): bool
    {
        if($form->isSubmitted() && $form->isValid()) {
            
            $article = $this->articleBuilder->create(
                                                                                    $form->getData()->title,
                                                                                    $form->getData()->content,
                                                                                    new \DateTime(),
                                                                                    $form->getData()->online,
                                                                                    $this->tokenStorage->getToken()->getUser(),
                                                                                    $form->getData()->personnalButton,
                                                                                    $this->stringReplaceHelper->replace($form->getData()->title),
                                                                                    $form->getData()->prestation
                                                                                );

            $this->validator->validate($article, [], [
                'article_creation'
            ]);

            $this->articleRepository->save($this->articleBuilder->getArticle(), $gallery);

            $this->session->getFlashBag()->add('success', 'Article bien ajouté');

            return true;
        }
        return false;
    }
}
