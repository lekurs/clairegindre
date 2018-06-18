<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 11/06/2018
 * Time: 12:51
 */

namespace App\UI\Action\Security\Interfaces;


use App\UI\Responder\Security\Interfaces\UserConnectionResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface LoginActionInterface
{
    /**
     * LoginActionInterface constructor.
     *
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory);

    /**
     * @param Request $request
     * @param UserConnectionResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, UserConnectionResponderInterface $responder);
}