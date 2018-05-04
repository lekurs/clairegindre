<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 13:51
 */

namespace App\UI\Responder\Reviews;


use App\UI\Responder\Interfaces\DeleteReviewsResponderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DeleteReviewsResponder implements DeleteReviewsResponderInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * DeleteReviewsResponder constructor.
     *
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function __invoke()
    {
        return $response = new RedirectResponse($this->urlGenerator->generate('adminAddReviews'));
    }
}
