<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 30/04/2018
 * Time: 22:57
 */

namespace App\UI\Action\Admin\Interfaces;


use App\Domain\Builder\Interfaces\PictureBuilderInterface;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\UI\Responder\Admin\Interfaces\DeletePictureResponderInterface;
use Symfony\Component\HttpFoundation\Request;

interface DeletePictureActionInterface
{
    /**
     * DeletePictureActionInterface constructor.
     *
     * @param PictureRepositoryInterface $repository
     * @param PictureBuilderInterface $pictureBuilder
     */
    public function __construct(PictureRepositoryInterface $repository, PictureBuilderInterface $pictureBuilder);

    /**
     * @param Request $request
     * @param DeletePictureResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, DeletePictureResponderInterface $responder);

}