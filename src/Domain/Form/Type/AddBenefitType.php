<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 27/03/2018
 * Time: 16:34
 */

namespace App\Domain\Form\Type;

use App\Domain\DTO\BenefitCreationDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddBenefitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Titre de la prestation',
                'label_attr' => ['class' => 'label-admin'],
                'attr' => ['class' => 'admin-input']
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => BenefitCreationDTO::class,
            'empty_data' => function (FormInterface $form) {
                                return new BenefitCreationDTO(
                                   $form->get('name')->getData()
                                );
            },
            'validation_groups' => ['benefit_creation']
        ));
    }
}
