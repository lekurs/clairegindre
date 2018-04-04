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
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddBenefitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => BenefitCreationDTO::class
        ));
    }

}