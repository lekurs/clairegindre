<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 03/04/2018
 * Time: 10:56
 */

namespace App\UI\Form\FormHandler\Interfaces;


use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\Services\PictureUploaderHelper;
use App\Services\SlugHelper;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface RegistrationTypeHandlerInterface
{
    /**
     * RegistrationTypeHandlerInterface constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param SessionInterface $session
     * @param ValidatorInterface $validator
     * @param UserBuilderInterface $userBuilder
     * @param Filesystem $fileSystem
     * @param PictureUploaderHelper $pictureUploaderHelper
     * @param string $targetDir
     * @param SlugHelper $stringReplaceHelper
     * @param string $storageBackup
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
        string $storageBackup
    );

    /**
     * @param FormInterface $form
     * @return mixed
     */
    public function handle(FormInterface $form);
}