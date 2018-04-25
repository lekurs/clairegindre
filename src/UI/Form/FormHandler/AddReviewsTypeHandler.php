<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 25/04/2018
 * Time: 14:13
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Builder\Interfaces\ReviewsBuilderInterface;
use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Models\Picture;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\Services\PictureUploaderHelper;
use App\UI\Form\FormHandler\Interfaces\AddReviewsTypeHandlerInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddReviewsTypeHandler implements AddReviewsTypeHandlerInterface
{
    /**
     * @var ReviewsRepositoryInterface
     */
    private $reviewsRepository;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var ReviewsBuilderInterface
     */
    private $reviewsBuilder;

    /**
     * @var PictureUploaderHelper
     */
    private $pictureUploaderHelper;

    /**
     * @var string
     */
    private $targetDir;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * AddReviewsTypeHandler constructor.
     *
     * @param ReviewsRepositoryInterface $reviewsRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param ReviewsBuilderInterface $reviewsBuilder
     * @param PictureUploaderHelper $pictureUploaderHelper
     * @param string $targetDir
     * @param Filesystem $fileSystem
     */
    public function __construct(
        ReviewsRepositoryInterface $reviewsRepository,
        SessionInterface $session,
        ValidatorInterface $validator,
        ReviewsBuilderInterface $reviewsBuilder,
        PictureUploaderHelper $pictureUploaderHelper,
        string $targetDir,
        Filesystem $fileSystem
    ) {
        $this->reviewsRepository = $reviewsRepository;
        $this->session = $session;
        $this->validtor = $validator;
        $this->reviewsBuilder = $reviewsBuilder;
        $this->pictureUploaderHelper = $pictureUploaderHelper;
        $this->targetDir = $targetDir;
        $this->fileSystem = $fileSystem;
    }

    public function handle(FormInterface $form)
    {
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $this->fileSystem->mkdir($this->targetDir . '/reviews', 0777);
            } catch (IOExceptionInterface $exception) {
                echo "une erreur est survenue durant la création du répertoire : " . $exception->getPath();
            }

            $this->pictureUploaderHelper->move($form->getData()->image, $this->targetDir . '/reviews/' . $form->getData()->title);

            $picture = new Picture($form->getData()->image->getClientOriginalName(), '/images/upload/reviews', $form->getData()->image->getClientExtension());

            $reviews = $this->reviewsBuilder->create(
                $form->getData()->title,
                $form->getData()->content,
                new \DateTime(),
                'tata',
                '/images/upload/reviews',
                $form->getData()->picture->getClientOriginalName()
            );
            $this->validator->validate($reviews, [], [
                'reviews_creation']);

            $this->reviewsRepository->save($this->reviewsBuilder->getReviews());

            $this->session->getFlashbag()->add('success', 'Votre avis client à été ajouté');

            return true;
        }
        return false;
    }
}