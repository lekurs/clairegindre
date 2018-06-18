<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 30/04/2018
 * Time: 22:57
 */

namespace App\UI\Action\Admin;


use App\Domain\Builder\Interfaces\PictureBuilderInterface;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\UI\Action\Admin\Interfaces\DeletePictureActionInterface;
use App\UI\Responder\Admin\Interfaces\DeletePictureResponderInterface;
use Symfony\Component\HttpFoundation\Request;

final class DeletePictureAction implements DeletePictureActionInterface
{
    /**
     * @var PictureRepositoryInterface
     */
    private $repository;

    /**
     * @var PictureBuilderInterface
     */
    private $pictureBuilder;

    /**
     * DeletePictureAction constructor.
     *
     * @param PictureRepositoryInterface $repository
     * @param PictureBuilderInterface $pictureBuilder
     */
    public function __construct(
        PictureRepositoryInterface $repository,
        PictureBuilderInterface $pictureBuilder
    ) {
        $this->repository = $repository;
        $this->pictureBuilder = $pictureBuilder;
    }


    public function __invoke(Request $request, DeletePictureResponderInterface $responder)
    {
        $this->pictureBuilder->create();

        $this->repository->delete($this->pictureBuilder->getPicture());

        return $responder();
    }
}
