<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/02/2018
 * Time: 10:31
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterForm extends AbstractType
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
            ->add('password', PasswordType::class, array(
                'label' => 'Mot de passe',
                'required' => true,
            ))
            ->add('date_wedding', DateType::class, array(
                'label' => 'Date évèvement',
                'widget' => 'single_text',
                'required' => true,
            ))
//            ->add('type', TextType::class, array(
//                'label' => 'Type d\'évènement',
//            ))
            ->add('picture', FileType::class, array(
                'label' => 'Thumbnail présentation'
            ))
            ;
    }
}