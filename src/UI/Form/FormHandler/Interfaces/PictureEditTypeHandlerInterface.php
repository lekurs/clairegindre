<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 11:21
 */

namespace App\UI\Form\FormHandler\Interfaces;


use App\Domain\Builder\Interfaces\PictureBuilderInterface;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface PictureEditTypeHandlerInterface
{
    /**
     * PictureEditTypeHandler constructor.
     *
     * @param PictureRepositoryInterface $pictureRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param PictureBuilderInterface $pictureBuilder
     */
    public function __construct(
        PictureRepositoryInterface $pictureRepository,
        SessionInterface $session,
        ValidatorInterface $validator,
        PictureBuilderInterface $pictureBuilder
    );

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}
