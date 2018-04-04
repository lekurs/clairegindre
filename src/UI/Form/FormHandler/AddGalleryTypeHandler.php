<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 11:07
 */

namespace App\UI\Form\FormHandler;


use App\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\AddGalleryTypeHandlerInterface;
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
     * AddGalleryTypeHandler constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param GalleryBuilderInterface $galleryBuilder
     */
    public function __construct(
        GalleryRepositoryInterface $galleryRepository,
        SessionInterface $session,
        ValidatorInterface $validator,
        GalleryBuilderInterface $galleryBuilder
    ) {
        $this->galleryRepository = $galleryRepository;
        $this->session = $session;
        $this->validator = $validator;
        $this->galleryBuilder = $galleryBuilder;
    }

    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isSubmitted()) {
            $gallery = $this->galleryBuilder->create(); //Créer le constructeur de gallery

            $this->validator->validate($gallery, [], [
                'gallery_creation'
            ]);

            $this->galleryRepository->save($gallery);

            $this->session->getFlashBag()->add('success', 'La galerie client à bien été ajoutée');

            return true;
        }
        return false;
    }
}
