<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 25/04/2018
 * Time: 14:05
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\AddReviewsDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddReviewsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'label_attr' => ['class' => 'label-admin'],
                'attr' => ['class' => 'admin-input'],
                'required' => true,
            ])
            ->add('content', TextareaType::class,  [
                'label' => 'Avis client',
                'label_attr' => ['class' => 'label-admin'],
                'attr' => ['class' => 'admin-input'],
                'required' => false,
            ])
            ->add('online', CheckboxType::class, [
                'required' => false,
                "attr" => ['class' => 'mycheckbox'],
                'label' => 'Mise en ligne',
                'label_attr' => ['class' => 'label-admin']
            ])
            ->add('image', FileType::class, [
                'label_attr' => ['class' => 'label-hidden']
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddReviewsDTO::class,
            'empty_data' =>  function (FormInterface $form) {
                            return new AddReviewsDTO(
                                $form->get('title')->getData(),
                                $form->get('content')->getData(),
                                $form->get('online')->getData(),
                                $form->get('image')->getData()
                            );
                    },
            'validation_groups' => ['reviews_creation']
        ]);
    }
}
