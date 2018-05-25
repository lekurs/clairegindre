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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddCommentOnArticleType extends AbstractType
{
    /**
     * @var CommentPostSubscriber
     */
    private $commentPostListener;

    /**
     * AddCommentOnArticleType constructor.
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
                'required' => false
            ])

            ->addEventSubscriber($this->commentPostListener);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddCommentOnArticleDTO::class,
            'empty_data' => function(FormInterface $form) {
                            return new AddCommentOnArticleDTO(
                               $form->get('content')->getData()
                            );
                    }
        ]);
    }
}
