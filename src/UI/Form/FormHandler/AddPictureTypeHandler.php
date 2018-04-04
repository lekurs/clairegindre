<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 11:13
 */

namespace App\UI\Form\FormHandler;


use App\Builder\Interfaces\PictureBuilderInterface;
use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\UI\Form\FormHandler\Interfaces\AddPictureTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddPictureTypeHandler implements AddPictureTypeHandlerInterface
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
     * AddPictureTypeHandler constructor.
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
            $picture = $this->pictureBuilder->create($form->getData()); //A confirmer

            $this->validator->validate($picture, [], [
                'picture_creation'
            ]);

            $this->pictureRepository->save($picture);

            $this->session->getFlashBag()->add('success', 'Image enregistrée');

            return true;
        }
        return false;
    }
}
