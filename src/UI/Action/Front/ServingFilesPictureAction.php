<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 16/05/2018
 * Time: 22:06
 */

namespace App\UI\Action\Front;


use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\Services\SlugHelper;
use App\UI\Action\Front\Interfaces\ServingFilesPictureActionInterface;
use App\UI\Responder\ServingFiles\ServingFilesPictureResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ServingFilesPictureAction
 *
 * @Route(
 *     name="servingFile",
 *     path="gallery/servingfiles"
 * )
 *
 */
class ServingFilesPictureAction implements ServingFilesPictureActionInterface
{
    /**
     * @var PictureRepositoryInterface
     */
    private $pictureRepository;

    /**
     * @var string
     */
    private $targetDirPublic;

    /**
     * @var SlugHelper
     */
    private $slugHelper;

    /**
     * ServingFilesPictureAction constructor.
     * @param PictureRepositoryInterface $pictureRepository
     * @param string $targetDirPublic
     * @param SlugHelper $slugHelper
     */
    public function __construct(PictureRepositoryInterface $pictureRepository, string $targetDirPublic, SlugHelper $slugHelper)
    {
        $this->pictureRepository = $pictureRepository;
        $this->targetDirPublic = $targetDirPublic;
        $this->slugHelper = $slugHelper;
    }


    public function __invoke(Request $request, ServingFilesPictureResponder $responder)
    {
        $picture = $this->pictureRepository->getOne($request->request->get('id'));

        $filePath = str_replace('\\', '/', $this->targetDirPublic) . $picture->getPublicPath() . '/' . $picture->getPictureName();

        return $responder($filePath);
    }
}
