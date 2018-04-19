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
use App\Services\PictureUploaderHelper;
use App\UI\Form\FormHandler\Interfaces\AddGalleryTypeHandlerInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddGalleryTypeHandler implements AddGalleryTypeHandlerInterface
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
     * @var string
     */
    private $targetDir;

    /**
     * AddGalleryTypeHandler constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param GalleryBuilderInterface $galleryBuilder
     * @param PictureUploaderHelper $pictureUploaderHelper
     * @param Filesystem $fileSystem
     * @param string $targetDir
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        SessionInterface $session,
        ValidatorInterface $validator,
        GalleryBuilderInterface $galleryBuilder,
        PictureUploaderHelper $pictureUploaderHelper,
        Filesystem $fileSystem,
        string $targetDir
    ) {
        $this->galleryRepository = $galleryRepository;
        $this->session = $session;
        $this->validator = $validator;
        $this->galleryBuilder = $galleryBuilder;
        $this->pictureUploaderHelper = $pictureUploaderHelper;
        $this->fileSystem = $fileSystem;
        $this->targetDir = $targetDir;
    }


    public function handle(FormInterface $form, UserInterface $user): bool
    {
        if($form->isSubmitted() && $form->isSubmitted()) {

            $i = 0;

            try {
                $this->fileSystem->mkdir($this->targetDir . '/gallery', 0777);
            } catch (IOExceptionInterface $exception) {
                echo "une erreur est survenue durant la création du répertoire : ".$exception->getPath();
            }

            $this->galleryBuilder->create($form->getData()->title, $user, $form->getData()->benefit);

            foreach ($form->getData()->pictures as $pictures) {

                $this->pictureUploaderHelper->move($pictures, $this->targetDir . '/gallery/' . $form->getData()->title, $pictures->getClientOriginalName());

                $this->galleryBuilder->withPicture(
                    new Picture($pictures->getClientOriginalName(), 'images/upload/gallery/' . $form->getData()->title, $pictures->guessClientExtension(), $i++)
                );

//                    $this->validator->validate($gallery, [], [
//                        'gallery_creation'
//                    ]);
            }



            $this->galleryRepository->save($this->galleryBuilder->getGallery());

            $this->session->getFlashBag()->add('success', 'La galerie client à bien été ajoutée');

            return true;
        }
        return false;
    }
}
