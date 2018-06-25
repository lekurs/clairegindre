<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 26/04/2018
 * Time: 10:36
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\UserLoginDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'email@email.com',
                'label_attr' => ['class' => 'label-admin'],
                'attr' => ['class' => 'admin-input'],
                'required' => true,
            ])
            ->add('password', PasswordType::class, [
                'label' => 'password',
                'label_attr' => ['class' => 'label-admin'],
                'attr' => ['class' => 'admin-input'],
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserLoginDTO::class,
            'empty_data' => function(FormInterface $form) {
                            return new UserLoginDTO(
                                $form->get('username')->getData(),
                                $form->get('password')->getData()
                            );
            }

        ]);
    }

}