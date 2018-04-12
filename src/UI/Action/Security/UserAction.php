<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 16:51
 */

namespace App\UI\Action\Security;


use App\Domain\Models\User;
use App\UI\Action\Security\Interfaces\UserActionInterface;
use App\UI\Responder\Security\Interfaces\UserResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
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
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * UserAction constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function __invoke(UserResponderInterface $responder)
    {
        $users = $this->entityManager->getRepository(User::class)->showGalleryByUser();

        return $responder($users);
    }

}