<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/02/2018
 * Time: 16:38
 */

namespace App\Type;


use App\Entity\Benefit;
use App\Entity\Interfaces\GalleryInterface;
use App\Subscriber\GalleryImageUploadSubscriber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalleryType extends AbstractType
{
    /**
     * @var GalleryImageUploadSubscriber
     */
    private $galleryImageUploadSubscriber;

    /**
     * GalleryType constructor.
     * @param GalleryImageUploadSubscriber $galleryImageUploadSubscriber
     */
    public function __construct(GalleryImageUploadSubscriber $galleryImageUploadSubscriber)
    {
        $this->galleryImageUploadSubscriber = $galleryImageUploadSubscriber;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('benefit', EntityType::class, array(
                    'class' => Benefit::class,
                    'choice_label' => 'name',
                    'label_attr' => ['class' => 'sr-only',],
                    'constraints' => [
                        new UniqueEntity(['fields' => 'id'])
                    ]
                ))
                ->add('pictures', FileType::class, array(
                'multiple' => true,
                'mapped' => false,
            ))
        ;
        $builder->get('pictures')->addEventSubscriber($this->galleryImageUploadSubscriber);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => GalleryInterface::class,
        ));
    }
}
