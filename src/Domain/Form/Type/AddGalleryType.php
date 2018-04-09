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
use App\Domain\Models\Gallery;
use App\Domain\Models\User;
use App\Subscriber\GalleryImageUploadSubscriber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddGalleryType extends AbstractType
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
                ->add('pictures', FileType::class, array(
                'multiple' => true,
                'mapped' => false,
            ))
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username'
            ])
        ;
//        $builder->get('pictures')->addEventSubscriber($this->galleryImageUploadSubscriber);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => GalleryCreationDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                                return new GalleryCreationDTO(
                                            $form->get('benefit')->getData(),
                                            $form->get('title')->getData(),
                                            $form->get('pictures')->getData(),
                                            $form->get('user')->getData()
                                );
                        }
        ));
    }
}
