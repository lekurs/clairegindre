<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 29/04/2018
 * Time: 16:25
 */

namespace App\UI\Responder\Admin\Interfaces;


use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

interface DeleteBenefitResponderInterface
{
    /**
     * DeleteBenefitResponderInterface constructor.
     *
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator);

    /**
     * @return mixed
     */
    public function __invoke();
}