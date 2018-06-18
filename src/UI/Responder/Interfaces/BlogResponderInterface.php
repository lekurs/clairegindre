<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/04/2018
 * Time: 17:34
 */

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;
use Twig\Environment;

interface BlogResponderInterface
{
    /**
     * BlogResponderInterface constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @param FormInterface|null $form
     * @param $instagram
     * @param $galleries
     * @param $benefits
     * @param $reviews
     * @return mixed
     */
    public function __invoke(FormInterface $form = null, $instagram, $galleries, $benefits, $reviews);
}
