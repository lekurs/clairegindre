<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 10:33
 */

namespace App\UI\Form\FormHandler;


use App\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\GalleryOrderTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class GalleryOrderTypeHandler implements GalleryOrderTypeHandlerInterface
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
     * GalleryOrderTypeHandler constructor.
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
        if($form->isSubmitted() && $form->isValid()) {
            $gallery = $this->galleryBuilder->create(); //Passer les attributs dans le constructeur

            $this->validator->validate($gallery, [], [
                'gallery_order',
            ]);

            $this->galleryRepository->save($gallery);

            $this->session->getFlashBag()->add('success', 'La galerie à bien été modifiée');

            return true;
        }
        return false;
    }

}