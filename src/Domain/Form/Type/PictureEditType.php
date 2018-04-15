<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 14:41
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\Interfaces\PictureEditDTOInterface;
use App\Domain\DTO\PictureEditDTO;
use App\Domain\Models\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PictureEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('displayOrder', HiddenType::class, [
                'label_attr' => ['class' => 'sr-only'],
                ])
            ->add('favorite', RadioType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Picture::class

//                    PictureEditDTOInterface::class,
//                'empty_data' => function (FormInterface $form) {
//                        return new PictureEditDTO(
//                           $form->get('displayOrder')->getData(),
//                           $form->get('favorite')->getData()
//                        );
//                }
            ]);
    }

}