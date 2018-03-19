<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 16/02/2018
 * Time: 14:24
 */

namespace App\Type;


use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PictureType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('picture', FileType::class, array(
                'label' => 'Ajoutez votre image',
                'label_attr' => ['class' => 'sr-only']
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Picture::class,
        ));
    }

}