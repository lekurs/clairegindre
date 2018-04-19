<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 18/04/2018
 * Time: 17:27
 */

namespace App\UI\Action\Front;


use App\Domain\Builder\Interfaces\GalleryBuilderInterface;
use App\Domain\Form\Type\ContactType;
use App\Domain\Lib\InstagramLib;
use App\Domain\Models\Gallery;
use App\UI\Action\Front\Interfaces\GalleryCustomersActionInterface;
use App\UI\Responder\Interfaces\GalleryCustomersResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GalleryCustomersAction
 *
 * @Route(
 *     name="galleriesCustomers",
 *     path="galleries"
 * )
 *
 * @package App\UI\Action\Front
 */
class GalleryCustomersAction implements GalleryCustomersActionInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var GalleryBuilderInterface
     */
    private $galleryBuilder;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var InstagramLib
     */
    private $insta;

    /**
     * GalleryCustomersAction constructor.
     * @param EntityManagerInterface $entityManager
     * @param GalleryBuilderInterface $galleryBuilder
     * @param FormFactoryInterface $formFactory
     * @param InstagramLib $insta
     */
    public function __construct(EntityManagerInterface $entityManager, GalleryBuilderInterface $galleryBuilder, FormFactoryInterface $formFactory, InstagramLib $insta)
    {
        $this->entityManager = $entityManager;
        $this->galleryBuilder = $galleryBuilder;
        $this->formFactory = $formFactory;
        $this->insta = $insta;
    }


    public function __invoke(Request $request, GalleryCustomersResponderInterface $responder)
    {
        $galleries = $this->entityManager->getRepository(Gallery::class)->getAllWithPictures();

        foreach ($galleries as $gallery)
        {
//            dump($gallery->getPictures()->offsetGet(0));
        }
//        die();

        $contact = $this->formFactory->create(ContactType::class)->handleRequest($request);

        if($contact->isSubmitted() && $contact->isValid()) {

            return $responder(true, null, $galleries, $this->insta->show());
        }
        return $responder(false, $contact, $galleries, $this->insta->show());
    }

}