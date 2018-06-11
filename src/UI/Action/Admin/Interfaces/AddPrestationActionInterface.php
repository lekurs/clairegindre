<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 09/04/2018
 * Time: 12:18
 */

namespace App\UI\Action\Admin\Interfaces;


use App\UI\Form\FormHandler\AddBenefitTypeHandler;
use App\UI\Responder\Admin\Interfaces\AddPrestationResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface AddPrestationActionInterface
{
    /**
     * AddPrestationActionInterface constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param AddBenefitTypeHandler $addBenefitTypeHandler
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AddBenefitTypeHandler $addBenefitTypeHandler,
        EntityManagerInterface $entityManager
    );

    /**
     * @param Request $request
     * @param AddPrestationResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, AddPrestationResponderInterface $responder);
}