<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 16:51
 */

namespace App\UI\Action\Security;


use App\UI\Action\Security\Interfaces\UserActionInterface;
use App\UI\Responder\Security\Interfaces\UserResponderInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserAction
 *
 * @Route(
 *     name="adminUser",
 *     path="admin/users"
 * )
 *
 * @package App\UI\Action\Security
 */
class UserAction implements UserActionInterface
{
    public function __invoke(UserResponderInterface $responder)
    {
        return $responder();
    }

}