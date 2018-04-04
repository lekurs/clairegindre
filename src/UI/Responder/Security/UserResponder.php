<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 04/04/2018
 * Time: 17:07
 */

namespace App\UI\Responder\Security;


use App\Domain\Models\User;
use App\UI\Responder\Security\Interfaces\UserResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class UserResponder implements UserResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * UserResponder constructor.
     * @param Environment $twig
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }


    public function __invoke()
    {
        $users = $this->entityManager->getRepository(User::class)->showGalleryByUser();

        return new Response($this->twig->render('back/admin/users.html.twig', [
            'users' => $users,
        ]));
    }

}