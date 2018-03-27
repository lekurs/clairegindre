<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 15/02/2018
 * Time: 12:56
 */

namespace App\Type;


use App\Entity\Benefit;
use App\Repository\BenefitRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BenefitType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', EntityType::class, array(
                'class' => Benefit::class,
                'choice_label' => 'name',
                'label_attr' => ['class' => 'sr-only',],
            ))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Benefit::class,
            ));
    }
}
