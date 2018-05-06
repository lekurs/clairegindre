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
use App\UI\Responder\Interfaces\GalleryCustomerResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GalleryCustomerAction
 *
 * @Route(
 *     name="galleryCustomer",
 *     path="/gallery/{id}/{galleryId}",
 *     defaults={"galleryId" = null}
 * )
 *
 * @package App\UI\Action\Security
 */
class GalleryCustomerAction
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * GalleryCustomerAction constructor.
     * @param UserRepositoryInterface $userRepository
     * @param GalleryRepositoryInterface $galleryRepository
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(UserRepositoryInterface $userRepository, GalleryRepositoryInterface $galleryRepository, FormFactoryInterface $formFactory)
    {
        $this->userRepository = $userRepository;
        $this->galleryRepository = $galleryRepository;
        $this->formFactory = $formFactory;
    }


    public function __invoke(Request $request, GalleryCustomerResponderInterface $response)
    {
        if ($request->get('galleryId') != null)
        {
            $galleries = $this->galleryRepository->getGalleryByUserAndId($request->get('id'), $request->get('galleryId'));

            return $response($galleries);
        } else {

            $galleries = $this->galleryRepository->getGalleryByUser($request->get('id'));

            return $response($galleries);
        }
    }
}