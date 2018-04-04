<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 10:45
 */

namespace App\UI\Action\Front;
use App\Domain\Form\Type\ContactType;
use App\Domain\Lib\InstagramLib;
use App\UI\Action\Front\Interfaces\IndexActionInterface;
use App\UI\Form\FormHandler\Interfaces\ContactTypeHandlerInterface;
use App\UI\Responder\Interfaces\IndexResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexAction
 *
 * @Route(
 *     name="index",
 *     path="/"
 * )
 *
 * @package App\UI\Action\Index
 */
class IndexAction implements IndexActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ContactTypeHandlerInterface
     */
    private $contactHandler;

    /**
     * IndexAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param ContactTypeHandlerInterface $contactHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        ContactTypeHandlerInterface $contactHandler
    ) {
        $this->formFactory = $formFactory;
        $this->contactHandler = $contactHandler;
    }

    /**
     * @param Request $request
     * @param IndexResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, IndexResponderInterface $responder)
    {
        $contactType = $this->formFactory->create(ContactType::class)
                                                                        ->handleRequest($request);

        if($this->contactHandler->handle($contactType)) {
            return $responder(true);
        }
        return $responder(false, $contactType);
    }
}
