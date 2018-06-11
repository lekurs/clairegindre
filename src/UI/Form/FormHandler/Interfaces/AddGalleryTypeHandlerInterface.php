<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 11:07
 */

namespace App\UI\Form\FormHandler\Interfaces;


use App\Domain\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Services\PictureUploaderHelper;
use App\Services\SlugHelper;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface AddGalleryTypeHandlerInterface
{
    /**
     * AddGalleryTypeHandler constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param GalleryBuilderInterface $galleryBuilder
     * @param PictureUploaderHelper $pictureUploaderHelper
     * @param Filesystem $fileSystem
     * @param SlugHelper $replaceService
     * @param string $dirGallery
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        SessionInterface $session,
        ValidatorInterface $validator,
        GalleryBuilderInterface $galleryBuilder,
        PictureUploaderHelper $pictureUploaderHelper,
        Filesystem $fileSystem,
        SlugHelper $replaceService,
        string $dirGallery
    ) ;

    /**
     * @param FormInterface $form
     * @param $user
     * @return bool
     */
    public function handle(FormInterface $form, $user): bool;
}
