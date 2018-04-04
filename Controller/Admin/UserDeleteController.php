<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/02/2018
 * Time: 16:06
 */

namespace App\Controller\Admin;


use App\Builder\UserBuilder;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserDeleteController extends Controller
{
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);

        if(!$user)
        {
            throw $this->createNotFoundException(
                'Pas d\'utilisateur trouvé'
            );
        }

        $em->remove($user);
        $em->flush();

        $this->addFlash('user_delete_success', 'Utilisateur supprimé');

        return $this->redirectToRoute('admin');
    }
}