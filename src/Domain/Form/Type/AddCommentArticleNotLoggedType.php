<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 06/05/2018
 * Time: 23:43
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\AddCommentArticleNotLoggedDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AddCommentArticleNotLoggedType extends AbstractType
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * AddCommentArticleNotLoggedType constructor.
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddCommentArticleNotLoggedDTO::class,
            'empty_data' => function(FormInterface $form) {
                            return new AddCommentArticleNotLoggedDTO(
                               $form->get('lastName')->getData(),
                               $form->get('email')->getData(),
                               $form->get('content')->getData()
                            );
            }
        ]);
    }

}