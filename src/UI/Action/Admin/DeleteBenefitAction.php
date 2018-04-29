<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 29/04/2018
 * Time: 16:17
 */

namespace App\UI\Action\Admin;

use App\Domain\Models\Benefit;
use App\UI\Action\Admin\Interfaces\DeleteBenefitActionInterface;
use App\UI\Responder\Admin\Interfaces\DeleteBenefitResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class DeleteBenefitAction
 *
 * @Route(
 *     name="adminDeleteBenefit",
 *     path="admin/benefit/delete/{id}",

 * )
 *
 */
class DeleteBenefitAction implements DeleteBenefitActionInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorization;

    /**
     * DeleteBenefitAction constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param TokenStorageInterface $tokenStorage
     * @param AuthorizationCheckerInterface $authorization
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorization
    ) {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
        $this->authorization = $authorization;
    }


    public function __invoke(Request $request, DeleteBenefitResponderInterface $responder)
    {
        $benefit = $this->entityManager->getRepository(Benefit::class)->find($request->get('id'));

        $this->entityManager->remove($benefit);
        $this->entityManager->flush();

        return $responder();
    }
}