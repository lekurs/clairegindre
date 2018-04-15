<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 14:02
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\GalleryOrderDTO;
use App\Domain\DTO\Interfaces\GalleryOrderDTOInterface;
use App\Domain\DTO\PictureEditDTO;
use App\Domain\Models\Gallery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Subscriber\Interfaces\PictureEditTypeSubscriberInterface;

class GalleryOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pictures', CollectionType::class, [
                'entry_type' => PictureEditType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Gallery::class
//                GalleryOrderDTOInterface::class,
//            'empty_data' => function (FormInterface $form) {
//                    return new GalleryOrderDTO(
//                            $form->get('pictures')->getData()
//                    );
//            }
        ]);
    }
}