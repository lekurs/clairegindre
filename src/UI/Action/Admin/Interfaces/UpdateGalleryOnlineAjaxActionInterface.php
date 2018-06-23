<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 23/06/2018
 * Time: 13:12
 */

namespace App\UI\Action\Admin\Interfaces;


use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\UI\Responder\Admin\Interfaces\UpdateGalleryOnlineAjaxResponderInterface;
use Symfony\Component\HttpFoundation\Request;

interface UpdateGalleryOnlineAjaxActionInterface
{
    /**
     * UpdateGalleryOnlineAjaxActionInterface constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     */
    public function __construct(GalleryRepositoryInterface $galleryRepository);

    /**
     * @param Request $request
     * @param UpdateGalleryOnlineAjaxResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, UpdateGalleryOnlineAjaxResponderInterface $responder);
}