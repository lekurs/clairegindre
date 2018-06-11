<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 10:34
 */

namespace App\UI\Action\Security;


use App\Domain\Form\Type\LoginType;
use App\UI\Action\Security\Interfaces\LoginActionInterface;
use App\UI\Responder\Security\Interfaces\UserConnectionResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LoginAction
 *
 * @Route(
 *     name="login",
 *     path="login"
 * )
 *
 */
final class LoginAction implements LoginActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * LoginAction constructor.
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * @param Request $request
     * @param UserConnectionResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, UserConnectionResponderInterface $responder)
    {
        $form = $this->formFactory->create(LoginType::class)->handleRequest($request);

        return $responder($form);
    }
}
