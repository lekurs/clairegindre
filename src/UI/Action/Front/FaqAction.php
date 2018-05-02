<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 02/05/2018
 * Time: 10:33
 */

namespace App\UI\Action\Front;


use App\Domain\Form\Type\ContactType;
use App\Domain\Lib\InstagramLib;
use App\UI\Action\Front\Interfaces\FaqActionInterface;
use App\UI\Responder\Interfaces\FaqResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FaqAction
 *
 * @Route(
 *     name="faq",
 *     path="faq"
 * )
 *
 */
class FaqAction implements FaqActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var InstagramLib
     */
    private $instagramLib;

    /**
     * FaqAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param InstagramLib $instagramLib
     */
    public function __construct(FormFactoryInterface $formFactory, InstagramLib $instagramLib)
    {
        $this->formFactory = $formFactory;
        $this->instagramLib = $instagramLib;
    }

    public function __invoke(Request $request, FaqResponderInterface $responder)
    {
        $contactType = $this->formFactory->create(ContactType::class)->handleRequest($request);

        if ($contactType->isSubmitted() && $contactType->isValid()) {

        }

        return $responder(false, $contactType, $this->instagramLib->show());
    }

}
