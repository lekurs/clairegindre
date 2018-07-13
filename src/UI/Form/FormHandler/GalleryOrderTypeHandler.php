<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 10:33
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\GalleryOrderTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class GalleryOrderTypeHandler implements GalleryOrderTypeHandlerInterface
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

    /**
     * @param FormInterface $form
     * @param $gallery
     * @return bool
     */
    public function handle(FormInterface $form, $gallery): bool
    {
        if($form->isSubmitted() && $form->isValid()) {

            $galleryEdit = $gallery->update($form->getData());

            $this->validator->validate($galleryEdit, [], [
                'gallery_creation',
            ]);

            $this->galleryRepository->update();

            $this->session->getFlashBag()->add('success', 'La galerie à bien été modifiée');

            return true;
        }
        return false;
    }
}
