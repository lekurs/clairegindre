<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/04/2018
 * Time: 14:06
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\EditUserDTO;
use App\Domain\DTO\Interfaces\EditUserDTOInterface;
use App\Subscriber\Interfaces\EditUserSlugSubscriberInterface;
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

final class EditUserType extends AbstractType
{
    /**
     * @var EditUserSlugSubscriberInterface
     */
    private $editUserSlugSubscriber;

    /**
     * EditUserType constructor.
     *
     * @param EditUserSlugSubscriberInterface $editUserSlugSubscriber
     */
    public function __construct(EditUserSlugSubscriberInterface $editUserSlugSubscriber)
    {
        $this->editUserSlugSubscriber = $editUserSlugSubscriber;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Nom',
                'label_attr' => ['class' => 'label-admin'],
                'attr' => ['class' => 'admin-input'],
                'required' => true,
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Prénom',
                'label_attr' => ['class' => 'label-admin'],
                'attr' => ['class' => 'admin-input'],
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'label_attr' => ['class' => 'label-admin'],
                'attr' => ['class' => 'admin-input'],
                'required' => true,
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Mot de passe',
                'label_attr' => ['class' => 'label-admin'],
                'attr' => ['class' => 'admin-input'],
                'required' => false,
            ])
            ->add('weddingDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('online', CheckboxType::class, [
                'required' => false,
                'attr' => ['class' => 'mycheckbox'],
                'label' => 'Actif ?'
            ])
            ->addEventSubscriber($this->editUserSlugSubscriber)
            ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EditUserDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                                            return new EditUserDTO(
                                                $form->get('username')->getData(),
                                                $form->get('lastName')->getData(),
                                                $form->get('email')->getData(),
                                                $form->get('plainPassword')->getData(),
                                                $form->get('online')->getData(),
                                                $form->get('weddingDate')->getData()
                                            );
                                },
            'validation_groups' => ['user_creation']
        ]);
    }
}
