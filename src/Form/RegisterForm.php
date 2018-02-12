<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/02/2018
 * Time: 10:31
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('emailRegistration', EmailType::class, array(
                'label' => 'Email',
                'required' => true,
            ))
            ->add('nameRegistration', TextType::class, array(
                'label' => 'Nom',
                'required' => true,
            ))
            ->add('lastNameRegistration', TextType::class, array(
                'label' => 'Prénom',
                'required' => true,
            ))
            ->add('passwordRegistration', PasswordType::class, array(
                'label' => 'Mot de passe',
                'required' => true,
            ))
            ;
    }
}