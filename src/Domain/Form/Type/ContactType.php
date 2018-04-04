<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/02/2018
 * Time: 11:42
 */

namespace App\Domain\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Nom :',
                'label_attr' => ['class' => 'label_contact'],
                'required' => true,
                ))
            ->add('firstname', TextType::class, array(
                'label' => 'Prénom :',
                'label_attr' => ['class' => 'label_contact'],
                'required' => true,
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Email :',
                'label_attr' => ['class' => 'label_contact'],
                'required' => true,
            ))
            ->add('phone', TelType::class, array(
                'label' => 'Téléphone',
                'label_attr' => ['class' => 'label_contact'],
                'required' => true,
            ))
            ->add('date', DateType::class, array(
                'label' => 'Date de l\'évenement',
                'label_attr' => ['class' => 'label_contact'],
                'widget' => 'single_text',
                'required' => true,
            ))
            ->add('place', TextType::class, array(
                'label' => 'Lieu de l\'évenement',
                'label_attr' => ['class' => 'label_contact'],
                'required' => false,
            ))
            ->add('howKnow', TextType::class, array(
                'label' => 'Comment m\'avez vous connu',
                'label_attr' => ['class' => 'label_contact'],
                'required' => false,
            ))
            ->add('event', CheckboxType::class, array(
                'label' => 'Mariage',
                'required' => false,
            ))
            ->add('eventCouple', CheckboxType::class, array(
                'label' => 'Couple',
                'required' => false,
            ))
            ->add('eventFamily', CheckboxType::class, array(
                'label' => 'Famille',
                'required' => false,
            ))
            ->add('details', TextareaType::class, array(
                'label' => 'Tous les détails de votre évènement m\'intéresse, le style de votre mariage, le nombre d\'invités, le type de cérémonie ...',
                'label_attr' => ['class' => 'label_contact'],
                'required' => true,
            ));
    }
}