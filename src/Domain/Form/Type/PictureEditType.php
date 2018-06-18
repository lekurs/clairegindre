<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 14:41
 */

namespace App\Domain\Form\Type;


use App\Domain\Models\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class PictureEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('displayOrder', HiddenType::class, [
                'label_attr' => ['class' => 'sr-only'],
                ])
            ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Picture::class
            ]);
    }
}
