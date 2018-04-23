<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 11:23
 */

namespace App\UI\Action\Admin;


use App\UI\Action\Admin\Interfaces\AdminActionInterface;
use App\UI\Responder\Admin\Interfaces\AdminResponderInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

/**
 * Class AdminAction
 *
 * @Route(
 *     name="admin",
 *     path="/admin"
 * )
 *
 * @package App\UI\Action\Admin
 */
class AdminAction implements AdminActionInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * AdminAction constructor.
     * @param TokenStorageInterface $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(TokenStorageInterface $tokenStorage, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
    }


    /**
     * @param AdminResponderInterface $responder
     * @return mixed
     */
    public function __invoke(AdminResponderInterface $responder)
    {
//        dump($this->tokenStorage->getToken('authenticate'));

        if(false === $this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('pas accès !');
        }
        return $responder();
    }
}
