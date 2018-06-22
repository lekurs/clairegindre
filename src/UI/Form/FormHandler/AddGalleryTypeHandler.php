<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 11:07
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Builder\BenefitBuilder;
use App\Domain\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Models\Picture;
use App\Domain\Models\User;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Infra\GCP\Storage\Helper\Interfaces\StorageWriterInterface;
use App\Infra\GCP\Storage\Service\Interfaces\FileHelperInterface;
use App\Services\PictureUploaderHelper;
use App\Services\SlugHelper;
use App\UI\Form\FormHandler\Interfaces\AddGalleryTypeHandlerInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class AddGalleryTypeHandler implements AddGalleryTypeHandlerInterface
{
    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var GalleryBuilderInterface
     */
    private $galleryBuilder;

    /**
     * @var PictureUploaderHelper
     */
    private $pictureUploaderHelper;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var SlugHelper
     */
    private $replaceService;

    /**
     * @var string
     */
    private $dirGallery;

    /**
     * @var FileHelperInterface
     */
    private $fileHelper;

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
     * @param FileHelperInterface $fileHelper
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        SessionInterface $session,
        ValidatorInterface $validator,
        GalleryBuilderInterface $galleryBuilder,
        PictureUploaderHelper $pictureUploaderHelper,
        Filesystem $fileSystem,
        SlugHelper $replaceService,
        string $dirGallery,
        FileHelperInterface $fileHelper
    ) {
        $this->galleryRepository = $galleryRepository;
        $this->session = $session;
        $this->validator = $validator;
        $this->galleryBuilder = $galleryBuilder;
        $this->pictureUploaderHelper = $pictureUploaderHelper;
        $this->fileSystem = $fileSystem;
        $this->replaceService = $replaceService;
        $this->dirGallery = $dirGallery;
        $this->fileHelper = $fileHelper;
    }

    /**
     * @param FormInterface $form
     * @param $user
     * @return bool
     */
    public function handle(FormInterface $form, $user): bool
    {
        if($form->isSubmitted() && $form->isSubmitted()) {

            try {
                $this->fileSystem->mkdir($this->dirGallery, 0777);
            } catch (IOExceptionInterface $exception) {
                echo "une erreur est survenue durant la création du répertoire : ".$exception->getPath();
            }

            $gallery = $this->galleryBuilder->create(
                $form->getData()->title,
                $user, $form->getData()->eventDate,
                $form->getData()->eventPlace,
                $form->getData()->benefit,
                $this->replaceService->replace($form->getData()->title),
                new \DateTime()
            );

            if(!$this->fileSystem->exists($this->dirGallery . $this->replaceService->replace($form->getData()->title))) {

                $this->fileSystem->mkdir($this->dirGallery . $this->replaceService->replace($form->getData()->title), 0755);
            }

            $this->validator->validate($gallery, [], [
                'gallery_creation'
            ]);

            $this->galleryRepository->save($this->galleryBuilder->getGallery());

            $this->session->getFlashBag()->add('success', 'La galerie client à bien été ajoutée');

            return true;
        }
        return false;
    }
}
