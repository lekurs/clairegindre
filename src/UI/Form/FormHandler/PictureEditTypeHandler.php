<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 11:43
 */

namespace App\UI\Form\FormHandler;


use App\Domain\Builder\Interfaces\PictureBuilderInterface;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\PictureEditTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PictureEditTypeHandler implements PictureEditTypeHandlerInterface
{
    /**
     * @var PictureRepositoryInterface
     */
    private $pictureRepository;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var PictureBuilderInterface
     */
    private $pictureBuilder;

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
    ) {
        $this->pictureRepository = $pictureRepository;
        $this->session = $session;
        $this->validator = $validator;
        $this->pictureBuilder = $pictureBuilder;
    }

    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {
            $picture = $this->pictureBuilder->create(); //Ajouter les attributs

            $this->validator->validate($picture, [], [
                'picture_edit'
            ]);

            $this->pictureRepository->save($picture);

            $this->session->getFlashBag()->add('success', 'Images mises à jour');

            return true;
        }
        return false;
    }

}