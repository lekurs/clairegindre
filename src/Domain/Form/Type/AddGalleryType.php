<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/02/2018
 * Time: 16:38
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\GalleryCreationDTO;
use App\Domain\DTO\Interfaces\GalleryCreationDTOInterface;
use App\Domain\Models\Benefit;
use App\Subscriber\GalleryImageUploadSubscriber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddGalleryType extends AbstractType
{
    /**
     * @var GalleryImageUploadSubscriber
     */
    private $galleryImageUploadSubscriber;

    /**
     * AddGalleryType constructor.
     *
     * @param GalleryImageUploadSubscriber $galleryImageUploadSubscriber
     */
    public function __construct(GalleryImageUploadSubscriber $galleryImageUploadSubscriber)
    {
        $this->galleryImageUploadSubscriber = $galleryImageUploadSubscriber;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
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
                ->add('title', TextType::class)
                ->add('user', HiddenType::class)
                ->add('eventDate', DateType::class)
                ->add('eventPlace', TextType::class)
            ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => GalleryCreationDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                                return new GalleryCreationDTO(
                                            $form->get('benefit')->getData(),
                                            $form->get('title')->getData(),
                                            $form->get('user')->getData(),
                                            $form->get('eventDate')->getData(),
                                            $form->get('eventPlace')->getData()
                                );
                        },
            'validation_groups' => ['gallery_creation']
        ));
    }
}
