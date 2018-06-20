<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 06/05/2018
 * Time: 23:43
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\AddCommentOnArticleDTO;
use App\Subscriber\CommentPostSubscriber;
use App\Subscriber\AddCommentArticleTypeSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddCommentOnArticleType extends AbstractType
{
    /**
     * @var CommentPostSubscriber
     */
    private $commentPostListener;

    /**
     * AddCommentOnArticleType constructor.
     *
     * @param CommentPostSubscriber $commentPostListener
     */
    public function __construct(CommentPostSubscriber $commentPostListener)
    {
        $this->commentPostListener = $commentPostListener;
    }


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, [
                'label_attr' => ['class' => 'label-hidden'],
                'required' => false,
                'attr' => ['class' => 'comment-form', 'placeholder' => 'Votre commentaire']
            ])

            ->addEventSubscriber($this->commentPostListener);

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddCommentOnArticleDTO::class,
            'empty_data' => function(FormInterface $form) {
                            return new AddCommentOnArticleDTO(
                               $form->get('content')->getData()
                            );
                    },
            'validation_groups' => ['add_comment']
        ]);
    }
}
