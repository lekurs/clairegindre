<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 29/04/2018
 * Time: 16:25
 */

namespace App\UI\Responder\Admin;


use App\UI\Responder\Admin\Interfaces\DeleteBenefitResponderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class DeleteBenefitResponder implements DeleteBenefitResponderInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * DeleteBenefitResponder constructor.
     *
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @return mixed|RedirectResponse
     */
    public function __invoke()
    {
        return $response = new RedirectResponse($this->urlGenerator->generate('admin'));
    }
}
