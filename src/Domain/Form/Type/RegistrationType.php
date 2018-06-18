<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/02/2018
 * Time: 10:31
 */

namespace App\Domain\Form\Type;

use App\Domain\DTO\Interfaces\RegistrationDTOInterface;
use App\Domain\DTO\RegistrationDTO;
use App\Subscriber\Interfaces\UserFolderSubscriberInterface;
use App\Subscriber\ProfileImageUploadSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class RegistrationType extends AbstractType
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

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'Email',
                'label_attr' => ['class' => 'label-admin'],
                'attr' => ['class' => 'admin-input'],
                'required' => true,
            ))
            ->add('username', TextType::class, array(
                'label' => 'Nom',
                'label_attr' => ['class' => 'label-admin'],
                'attr' => ['class' => 'admin-input'],
                'required' => true,
              ))
            ->add('lastName', TextType::class, array(
                'label' => 'Prénom',
                'label_attr' => ['class' => 'label-admin'],
                'attr' => ['class' => 'admin-input'],
                'required' => true,
            ))
            ->add('plainPassword', PasswordType::class, array(
                'label' => 'Mot de passe',
                'label_attr' => ['class' => 'label-admin'],
                'attr' => ['class' => 'admin-input'],
                'required' => true,
            ))
            ->add('dateWedding', DateType::class, array(
                'label' => 'Date évèvement',
                'label_attr' => ['class' => 'label-admin'],
                'attr' => ['class' => 'admin-input'],
                'widget' => 'single_text',
                'required' => true,
            ))
            ->add('picture', FileType::class, array(
                'label' => ' ',
                'label_attr' => ['class' => 'label-admin'],
            ))
            ->add('online', CheckboxType::class, [
                'label' => 'En ligne ?',
                'label_attr' => ['class' => 'label-admin'],
                'attr' => ['class' => 'admin-input'],
            ])
            ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => RegistrationDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                            return new RegistrationDTO(
                                $form->get('email')->getData(),
                                $form->get('username')->getData(),
                                $form->get('lastName')->getData(),
                                $form->get('plainPassword')->getData(),
                                $form->get('dateWedding')->getData(),
                                $form->get('picture')->getData(),
                                $form->get('online')->getData()
                            );
                        },
            'validation_groups' => ['user_creation']
        ));
    }
}
