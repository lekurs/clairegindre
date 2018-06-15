<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 14:02
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\EditGalleryDTO;
use App\Subscriber\Interfaces\EditSlugGallerySubscriberInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Subscriber\Interfaces\PictureEditTypeSubscriberInterface;

final class GalleryOrderType extends AbstractType
{
    /**
     * @var EditSlugGallerySubscriberInterface
     */
    private $editSlugGallerySubscriber;

    /**
     * GalleryOrderType constructor.
     *
     * @param EditSlugGallerySubscriberInterface $editSlugGallerySubscriber
     */
    public function __construct(EditSlugGallerySubscriberInterface $editSlugGallerySubscriber)
    {
        $this->editSlugGallerySubscriber = $editSlugGallerySubscriber;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pictures', CollectionType::class, [
                'entry_type' => PictureEditType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('title', TextType::class, [
                'label' => 'titre',
                'label_attr' => ['class' => 'label-admin-mini'],
                'attr' => ['class' => 'admin-input-mini']
            ])
            ->add('eventDate', DateType::class, [
                'label' => 'Date de l\'évenement',
                'label_attr' => ['class' => 'label-admin-mini'],
                'widget' => 'single_text',
                'required' => true,
                'attr' => ['class' => 'admin-input-mini']
            ])
            ->add('eventPlace', TextType::class, [
                'label' => 'Lieu',
                'label_attr' => ['class' => 'label-admin-mini'],
                'attr' => ['class' => 'admin-input-mini']
            ])
            ->addEventSubscriber($this->editSlugGallerySubscriber)
        ;

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        'data_class' => EditGalleryDTO::class,
        'empty_data' => function (FormInterface $form) {
            return new EditGalleryDTO(
                $form->get('title')->getData(),
                $form->get('eventDate')->getData(),
                $form->get('eventPlace')->getData()
            );
        }
        ]);
    }
}
