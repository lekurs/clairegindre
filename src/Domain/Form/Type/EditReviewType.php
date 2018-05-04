<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/05/2018
 * Time: 16:17
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\EditReviewsDTO;
use App\Domain\DTO\Interfaces\EditReviewsDTOInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('content', TextareaType::class)
            ->add('online', CheckboxType::class)
            ->add('image', FileType::class, [
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EditReviewsDTO::class,
            'empty_data' => function (FormInterface $form) {
                                return new EditReviewsDTO(
                                   $form->get('title')->getData(),
                                   $form->get('content')->getData(),
                                   $form->get('online')->getData(),
                                   $form->get('image')->getData()
                                );
                            }
        ]);
    }

}