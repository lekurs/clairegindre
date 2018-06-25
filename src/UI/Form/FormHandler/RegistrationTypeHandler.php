<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 10:57
 */

namespace App\UI\Form\FormHandler;

use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\Domain\Models\Picture;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\Services\PictureUploaderHelper;
use App\Services\SlugHelper;
use App\UI\Form\FormHandler\Interfaces\RegistrationTypeHandlerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class RegistrationTypeHandler implements RegistrationTypeHandlerInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var UserBuilderInterface
     */
    private $userBuilder;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var PictureUploaderHelper
     */
    private $pictureUploaderHelper;

    /**
     * @var string
     */
    private $targetDir;

    /**
     * @var SlugHelper
     */
    private $stringReplaceHelper;

    /**
     * @var string
     */
    private $urlStorageBackup;

    /**
     * RegistrationTypeHandler constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param UserBuilderInterface $userBuilder
     * @param Filesystem $fileSystem
     * @param PictureUploaderHelper $pictureUploaderHelper
     * @param string $targetDir
     * @param SlugHelper $stringReplaceHelper
     * @param string $urlStorageBackup
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        SessionInterface $session,
        ValidatorInterface $validator,
        UserBuilderInterface $userBuilder,
        Filesystem $fileSystem,
        PictureUploaderHelper $pictureUploaderHelper,
        string $targetDir,
        SlugHelper $stringReplaceHelper,
        string $urlStorageBackup
    ) {
        $this->userRepository = $userRepository;
        $this->session = $session;
        $this->validator = $validator;
        $this->userBuilder = $userBuilder;
        $this->fileSystem = $fileSystem;
        $this->pictureUploaderHelper = $pictureUploaderHelper;
        $this->targetDir = $targetDir;
        $this->stringReplaceHelper = $stringReplaceHelper;
        $this->urlStorageBackup = $urlStorageBackup;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {

            try {
            $this->fileSystem->mkdir($this->targetDir . '/customers', 777);
        } catch (IOExceptionInterface $exception) {
            echo "une erreur est survenue durant la création du répertoire : ".$exception->getPath();
        }

        $this->pictureUploaderHelper->move($form->getData()->picture, $this->targetDir . 'customers/', $form->getData()->picture->getClientOriginalName());

        $picture = new Picture($form->getData()->picture->getClientOriginalName(), '/images/upload/customers', '/images/upload/customers', $form->getData()->picture->guessClientExtension());

            $user = $this->userBuilder->create(
                    $form->getData()->email,
                    $form->getData()->username,
                    $form->getData()->lastName,
                    $form->getData()->plainPassword,
                    $form->getData()->dateWedding,
                    $picture,
                    '1',
                    'ROLE_USER',
                    $this->stringReplaceHelper->replace($form->getData()->username . '-' . $form->getData()->lastName)
                );

            $this->validator->validate($user, [], [
                'user_creation'
            ]);

            $this->userRepository->save($this->userBuilder->getUser());

            $this->session->getFlashBag()->add('success', 'L\'utilisateur à bien été ajouté');

            return true;
        }
        return false;
    }
}
