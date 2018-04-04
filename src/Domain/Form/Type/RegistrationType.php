<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/02/2018
 * Time: 10:31
 */

namespace App\Domain\Form\Type;

use App\Domain\DTO\Interfaces\RegistrationDTOInterface;
use App\Entity\User;
use App\Subscriber\Interfaces\ProfileImageUploadSubscriberInterface;
use App\Subscriber\Interfaces\UserFolderSubscriberInterface;
use App\Subscriber\ProfileImageUploadSubscriber;
use App\Subscriber\ReviewImageSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    /**
     * @var ProfileImageUploadSubscriber
     */
    private $profileImageUploadSubscriber;

    /**
     * @var UserFolderSubscriberInterface
     */
    private $userFolderSubscriber;

    /**
     * RegistrationType constructor.
     *
     * @param ProfileImageUploadSubscriber $profileImageUploadSubscriber
     * @param UserFolderSubscriberInterface $userFolderSubscriber
     */
    public function __construct(
        ProfileImageUploadSubscriber $profileImageUploadSubscriber,
        UserFolderSubscriberInterface $userFolderSubscriber
    ) {
        $this->profileImageUploadSubscriber = $profileImageUploadSubscriber;
        $this->userFolderSubscriber = $userFolderSubscriber;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'Email',
                'required' => true,
            ))
            ->add('username', TextType::class, array(
                'label' => 'Nom',
                'required' => true,
              ))
            ->add('lastName', TextType::class, array(
                'label' => 'Prénom',
                'required' => true,
            ))
            ->add('plainPassword', PasswordType::class, array(
                'label' => 'Mot de passe',
                'required' => true,
            ))
            ->add('date_wedding', DateType::class, array(
                'label' => 'Date évèvement',
                'widget' => 'single_text',
//                'html5' => false,
                'required' => true,
//                'attr' => ['class' => 'js-datepicker'],
            ))
            ->add('picture', FileType::class, array(
                'label' => 'Choisissez un fichier',
                'mapped' => false,
            ))
            ;
        $builder->get('picture')->addEventSubscriber($this->profileImageUploadSubscriber);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => RegistrationDTOInterface::class,
        ));
    }
}