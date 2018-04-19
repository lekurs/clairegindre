<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 18/04/2018
 * Time: 15:52
 */

namespace App\UI\Responder\Admin;


use App\UI\Responder\Admin\Interfaces\DeleteGalleryResponderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Flex\Response;

class DeleteGalleryResponder implements DeleteGalleryResponderInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * DeleteGalleryResponder constructor.
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function __invoke()
    {
        $response = new RedirectResponse($this->urlGenerator->generate('admin'));

        return $response;
    }

}