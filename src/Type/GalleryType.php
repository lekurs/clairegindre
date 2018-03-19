<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/02/2018
 * Time: 16:38
 */

namespace App\Type;


use App\Entity\Gallery;
use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('picture', CollectionType::class, array(
                'entry_type' => PictureType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'fichiers',
                'label_attr' => ['class' => 'sr-only',],
                'entry_options' => array(
                    'attr' => [
                        'class' => 'box_files',
                        'multiple' => true,
                        ]
                ),
            ))
            ->add('benefit', BenefitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Picture::class,
        ));
    }

}