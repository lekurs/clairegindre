<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/02/2018
 * Time: 16:38
 */

namespace App\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class GalleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('picturename', CollectionType::class, array(
                'entry_type' => FileType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => 'fichiers',
                'label_attr' => ['class' => 'sr-only',],
                'entry_options' => array(
                    'attr' => [
                        'class' => 'box_files',
                        'multiple' => true,
                        ]
                ),
            ))
            ->add('benefit')
        ;
    }

}