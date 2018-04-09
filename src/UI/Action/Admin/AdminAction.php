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
use Symfony\Component\Routing\Annotation\Route;

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
     * @param AdminResponderInterface $responder
     * @return mixed
     */
    public function __invoke(AdminResponderInterface $responder)
    {
        return $responder();
    }
}
