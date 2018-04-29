<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 29/04/2018
 * Time: 16:17
 */

namespace App\UI\Action\Admin\Interfaces;


use App\UI\Responder\Admin\Interfaces\DeleteBenefitResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

interface DeleteBenefitActionInterface
{
    /**
     * DeleteBenefitActionInterface constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param TokenStorageInterface $tokenStorage
     * @param AuthorizationCheckerInterface $authorization
     */
    public function __construct(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage, AuthorizationCheckerInterface $authorization);

    /**
     * @param Request $request
     * @param DeleteBenefitResponderInterface $deleteBenefitResponder
     * @return mixed
     */
    public function __invoke(Request $request, DeleteBenefitResponderInterface $deleteBenefitResponder);
}
