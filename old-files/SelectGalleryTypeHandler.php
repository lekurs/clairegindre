<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 12/05/2018
 * Time: 22:24
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SelectGalleryTypeHandler
{
    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * SelectGalleryTypeHandler constructor.
     * @param GalleryRepositoryInterface $galleryRepository
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(GalleryRepositoryInterface $galleryRepository, UrlGeneratorInterface $urlGenerator)
    {
        $this->galleryRepository = $galleryRepository;
        $this->urlGenerator = $urlGenerator;
    }


    /**
     * @param FormInterface $form
     * @return bool|RedirectResponse
     */
    public function handle(FormInterface $form)
    {
//        if($form->isSubmitted() && $form->isValid()) {
//
//            $gallery = $this->galleryRepository->getOne($form->getData()['title']->getSlug());
//
//            return new RedirectResponse($this->urlGenerator->generate('adminAddArticle', ['slug' => $gallery->getSlug()]));
//        }
//        return false;
    }
}