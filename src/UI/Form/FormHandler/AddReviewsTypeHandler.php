<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 25/04/2018
 * Time: 14:13
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Builder\Interfaces\ReviewsBuilderInterface;
use App\Domain\Models\Picture;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\Services\PictureUploaderHelper;
use App\UI\Form\FormHandler\Interfaces\AddReviewsTypeHandlerInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraints\DateTime;
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
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * AddReviewsTypeHandler constructor.
     * @param ReviewsRepositoryInterface $reviewsRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param ReviewsBuilderInterface $reviewsBuilder
     * @param PictureUploaderHelper $pictureUploaderHelper
     * @param string $targetDir
     * @param Filesystem $fileSystem
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        ReviewsRepositoryInterface $reviewsRepository,
        SessionInterface $session,
        ValidatorInterface $validator,
        ReviewsBuilderInterface $reviewsBuilder,
        PictureUploaderHelper $pictureUploaderHelper,
        string $targetDir,
        Filesystem $fileSystem,
        TokenStorageInterface $tokenStorage
    ) {
        $this->reviewsRepository = $reviewsRepository;
        $this->session = $session;
        $this->validator = $validator;
        $this->reviewsBuilder = $reviewsBuilder;
        $this->pictureUploaderHelper = $pictureUploaderHelper;
        $this->targetDir = $targetDir;
        $this->fileSystem = $fileSystem;
        $this->tokenStorage = $tokenStorage;
    }


    public function handle(FormInterface $form)
    {
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $this->fileSystem->mkdir($this->targetDir . '/reviews', 0777);
            } catch (IOExceptionInterface $exception) {
                echo "une erreur est survenue durant la création du répertoire : " . $exception->getPath();
            }

            $this->pictureUploaderHelper->move($form->getData()->image, $this->targetDir . '/reviews/' . str_replace(' ', '_', strtolower($form->getData()->title)), $form->getData()->image->getClientOriginalName());

            $picture = new Picture($form->getData()->image->getClientOriginalName(), '/images/upload/reviews/' .$form->getData()->title , $form->getData()->image->guessClientExtension());

            $reviews = $this->reviewsBuilder->create(
                                                                                        $form->getData()->title,
                                                                                        $form->getData()->content,
                                                                                        new \DateTime(),
                                                                                        $this->tokenStorage->getToken()->getUser(),
                                                                                        '/images/upload/reviews/'. str_replace(' ', '_', strtolower($form->getData()->title)),
                                                                                        $form->getData()->image->getClientOriginalName(),
                                                                                        $form->getData()->online
                                                                                    );

            $this->validator->validate($reviews, [], [
                'reviews_creation'
            ]);

            $this->reviewsRepository->save($this->reviewsBuilder->getReviews());

            $this->session->getFlashbag()->add('success', 'Votre avis client à été ajouté');

            return true;
        }
        return false;
    }
}