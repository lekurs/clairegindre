<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/02/2018
 * Time: 10:31
 */

namespace App\Type;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'Email',
                'required' => true,
            ))
            ->add('name', TextType::class, array(
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
            ->add('benefit', ChoiceType::class, array(
                'label' => 'Type d\'évènement',
                'choices' => array(
                   'Mariage' => 'mariage',
                   'Famille' => 'famille',
                   'Couple' => 'couple'
                ),

            ))
            ->add('picture', FileType::class, array(
                'label' => 'Choisissez un fichier',
//                'attr' => ['class' => 'custom-file-input']
            ))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}