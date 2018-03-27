<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/02/2018
 * Time: 16:38
 */

namespace App\Type;


use App\Entity\Gallery;
use App\Entity\Interfaces\GalleryInterface;
use App\Entity\Picture;
use App\Subscriber\GalleryImageUploadSubscriber;
use App\Subscriber\Interfaces\ProfileImageUploadSubscriberInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
//                ->add('benefit', BenefitType::class)
                ->add('picture', FileType::class, array(
                'multiple' => true,
                'mapped' => false,
            ))
        ;
        $builder->get('picture')->addEventSubscriber($this->galleryImageUploadSubscriber);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => GalleryInterface::class,
        ));
    }
}
