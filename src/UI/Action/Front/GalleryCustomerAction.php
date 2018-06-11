<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/04/2018
 * Time: 15:56
 */

namespace App\UI\Action\Front;

use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Action\Front\Interfaces\GalleryCustomerActionInterface;
use App\UI\Responder\Interfaces\GalleryCustomerResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GalleryCustomerAction
 *
 * @Route(
 *     name="galleryCustomer",
 *     path="/gallery/{slugUser}/{slugGallery}"
 * )
 *
 * @package App\UI\Action\Security
 */
final class GalleryCustomerAction implements GalleryCustomerActionInterface
{
    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * GalleryCustomerAction constructor.
     *
     * @param GalleryRepositoryInterface $galleryRepository
     */
    public function __construct(GalleryRepositoryInterface $galleryRepository)
    {
        $this->galleryRepository = $galleryRepository;
    }

    /**
     * @param Request $request
     * @param GalleryCustomerResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, GalleryCustomerResponderInterface $responder)
    {
            $gallery = $this->galleryRepository->getWithPictures($request->attributes->get('slugGallery'));

            return $responder($gallery);
    }
}
