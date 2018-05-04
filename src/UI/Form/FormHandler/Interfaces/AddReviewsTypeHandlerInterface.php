<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 25/04/2018
 * Time: 14:13
 */

namespace App\UI\Form\FormHandler\Interfaces;


use App\Domain\Builder\Interfaces\ReviewsBuilderInterface;
use App\Domain\Repository\Interfaces\ReviewsRepositoryInterface;
use App\Services\PictureUploaderHelper;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface AddReviewsTypeHandlerInterface
{
    /**
     * AddReviewsTypeHandlerInterface constructor.
     *
     * @param ReviewsRepositoryInterface $reviewsRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param ReviewsBuilderInterface $reviewsBuilder
     * @param PictureUploaderHelper $pictureUploaderHelper
     * @param string $targetDir
     * @param Filesystem $fileSystem
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(ReviewsRepositoryInterface $reviewsRepository, SessionInterface $session, ValidatorInterface $validator, ReviewsBuilderInterface $reviewsBuilder, PictureUploaderHelper $pictureUploaderHelper, string $targetDir, Filesystem $fileSystem, TokenStorageInterface $tokenStorage);

    /**
     * @param FormInterface $form
     * @return mixed
     */
    public function handle(FormInterface $form);

}