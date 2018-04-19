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
use App\UI\Form\FormHandler\Interfaces\AddArticleTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddArticleTypeHandler implements AddArticleTypeHandlerInterface
{
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
     * AddArticleTypeHandler constructor.
     *
     * @param ArticleRepositoryInterface $articleRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param ArticleBuilderInterface $articleBuilder
     */
    public function __construct(
        ArticleRepositoryInterface $articleRepository,
        SessionInterface $session,
        ValidatorInterface $validator,
        ArticleBuilderInterface $articleBuilder
    ) {
        $this->articleRepository = $articleRepository;
        $this->session = $session;
        $this->validator = $validator;
        $this->articleBuilder = $articleBuilder;
    }

    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());
//            die();
            $article = $this->articleBuilder->create($form->getData()->title, $form->getData()->content, $form->getData()->gallery);

            $this->validator->validate($article, [], [
                'article_creation'
            ]);

            $this->articleRepository->save($article);

            $this->session->getFlashBag()->add('success', 'Article bien ajouté');

            return true;
        }
        return false;
    }
}
