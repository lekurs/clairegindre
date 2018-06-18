<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 07/05/2018
 * Time: 14:51
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\AddCommentArticleUserConnectedDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddCommentArticleUserConnectedType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author', TextType::class)
            ->add('content', TextareaType::class, [
                'required' => false
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddCommentArticleUserConnectedDTO::class,
            'empty_data' => function(FormInterface $form) {
                            return new AddCommentArticleUserConnectedDTO(
                               $form->get('author')->getData(),
                               $form->get('content')->getData()
                            );
                    },
            'validation_groups' => ['comment_creation']
        ]);
    }

}