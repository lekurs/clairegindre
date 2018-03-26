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
use App\Subscriber\Interfaces\ProfileImageUploadSubscriberInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalleryType extends AbstractType
{
    /**
     * @var ProfileImageUploadSubscriberInterface
     */
    private $imageUploadSubscriber;

    /**
     * GalleryType constructor.
     *
     * @param ProfileImageUploadSubscriberInterface $imageUploadSubscriber
     */
    public function __construct(ProfileImageUploadSubscriberInterface $imageUploadSubscriber)
    {
        $this->imageUploadSubscriber = $imageUploadSubscriber;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('benefit', BenefitType::class)
                ->add('picture', FileType::class, array(
                'multiple' => true,
                'mapped' => false,
            ))
        ;
        $builder->get('picture')->addEventSubscriber($this->imageUploadSubscriber);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => GalleryInterface::class,
        ));
    }
}
