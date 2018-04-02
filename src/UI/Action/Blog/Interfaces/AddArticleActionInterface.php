<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:18
 */

namespace App\UI\Action\Blog\Interfaces;


use App\UI\Form\FormHandler\Interfaces\AddArticleTypeHandlerInterface;
use App\UI\Responder\Interfaces\AddArticleResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface AddArticleActionInterface
{
    /**
     * AddArticleActionInterface constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param AddArticleTypeHandlerInterface $addArticleTypeHandler
     */
    public function __construct(FormFactoryInterface $formFactory, AddArticleTypeHandlerInterface $addArticleTypeHandler);

    /**
     * @param Request $request
     * @param AddArticleResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AddArticleResponderInterface $responder);
}