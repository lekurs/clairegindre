<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 06/05/2018
 * Time: 23:43
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\AddCommentArticleUserUserNotConnectedDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AddCommentArticleUserNotConnectedType extends AbstractType
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * AddCommentArticleUserNotConnectedType constructor.
     *
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', TextType::class)
            ->add('email', EmailType::class)
            ->add('content', TextareaType::class, [
                'required' => false
            ])
//            ->add('article', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddCommentArticleUserUserNotConnectedDTO::class,
            'empty_data' => function(FormInterface $form) {
                            return new AddCommentArticleUserUserNotConnectedDTO(
                               $form->get('lastName')->getData(),
                               $form->get('email')->getData(),
                               $form->get('content')->getData(),
                               $form->get('article')->getData()
                            );
                    }
        ]);
    }

}