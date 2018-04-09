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
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface AddGalleryTypeHandlerInterface
{
    /**
     * AddGalleryTypeHandlerInterface constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param GalleryBuilderInterface $galleryBuilder
     */
//    public function __construct(GalleryRepositoryInterface $galleryRepository, SessionInterface $session, ValidatorInterface $validator, GalleryBuilderInterface $galleryBuilder, PictureUploaderHelper $pictureUploaderHelper, Filesystem $filesystem, string $targetDir);

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool;

}