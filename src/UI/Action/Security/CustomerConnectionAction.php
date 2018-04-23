<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/04/2018
 * Time: 15:56
 */

namespace App\UI\Action\Security;


use App\Domain\Models\User;
use App\UI\Responder\Interfaces\GalleryCustomerResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CustomerConnectionAction
 *
 * @Route(
 *     name="galleryCutomer",
 *     path="/gallery/{id}"
 * )
 *
 * @package App\UI\Action\Security
 */
class CustomerConnectionAction
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * CustomerConnectionAction constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request, GalleryCustomerResponderInterface $response)
    {
        $user = $this->entityManager->getRepository(User::class)->find($request->get('id'));

//        dump($user);

        return $response($user);
    }
}