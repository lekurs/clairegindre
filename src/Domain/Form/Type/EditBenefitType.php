<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 03/05/2018
 * Time: 22:24
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\EditBenefitDTO;
use App\Domain\DTO\Interfaces\EditBenefitDTOInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class EditBenefitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EditBenefitDTOInterface::class,
            'empty_data' => function(FormInterface $form) {
                            return new EditBenefitDTO(
                                $form->get('name')->getData()
                            );
                    },
            'validation_groups' => ['benefit_creation']
        ]);
    }
}
