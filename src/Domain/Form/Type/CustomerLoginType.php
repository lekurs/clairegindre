<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 30/04/2018
 * Time: 23:26
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\CustomerLoginTypeDTO;
use App\Domain\DTO\Interfaces\CustomerLoginTypeDTOInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CustomerLoginType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'email@email.com',
                'label_attr' => ['class' => 'label_contact'],
            ])
            ->add('password', PasswordType::class,  [
                'label' => 'password',
                'label_attr' => ['class' => 'label-modal']
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CustomerLoginTypeDTOInterface::class,
            'empty_data' => function(FormInterface $form) {
                                return new CustomerLoginTypeDTO(
                                    $form->get('username')->getData(),
                                    $form->get('password')->getData()
                                );
                    },
            'allow_extra_fields' => true
        ]);
    }
}