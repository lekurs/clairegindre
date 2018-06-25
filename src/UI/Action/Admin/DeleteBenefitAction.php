<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 29/04/2018
 * Time: 16:17
 */

namespace App\UI\Action\Admin;

use App\Domain\Repository\Interfaces\BenefitRepositoryInterface;
use App\UI\Action\Admin\Interfaces\DeleteBenefitActionInterface;
use App\UI\Responder\Admin\Interfaces\DeleteBenefitResponderInterface;
use App\UI\Responder\Errors\AuthenticationErrorsResponder;
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
final class DeleteBenefitAction implements DeleteBenefitActionInterface
{
    /**
     * @var BenefitRepositoryInterface
     */
    private $benefitRepository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorization;

    /**
     * @var AuthenticationErrorsResponder
     */
    private $errorResponder;

    /**
     * DeleteBenefitAction constructor.
     *
     * @param BenefitRepositoryInterface $benefitRepository
     * @param TokenStorageInterface $tokenStorage
     * @param AuthorizationCheckerInterface $authorization
     * @param AuthenticationErrorsResponder $errorResponder
     */
    public function __construct(
        BenefitRepositoryInterface $benefitRepository,
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorization,
        AuthenticationErrorsResponder $errorResponder
    ) {
        $this->benefitRepository = $benefitRepository;
        $this->tokenStorage = $tokenStorage;
        $this->authorization = $authorization;
        $this->errorResponder = $errorResponder;
    }

    /**
     * @param Request $request
     * @param DeleteBenefitResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, DeleteBenefitResponderInterface $responder)
    {
        if ($this->authorization->isGranted('ROLE_ADMIN')) {
            $benefit = $this->benefitRepository->getOne($request->get('id'));

            $this->entityManager->remove($benefit);
            $this->entityManager->flush();

            return $responder();
        } else {
            $error = $this->errorResponder;

            return $error();
        }
    }
}
