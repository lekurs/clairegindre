<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 06/05/2018
 * Time: 23:43
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\AddCommentOnArticleDTO;
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
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AddCommentOnArticleType extends AbstractType
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * AddCommentOnArticleType constructor.
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
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

            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $user = $this->tokenStorage->getToken()->getUser();
//                $email = $event->getData()->get('email');
//                $lastName = $event->getData()->get('lastName');
                $form = $event->getForm();

                if (!$user) {
                    return;
                }

                if (true === $user) {
                    $form
                        ->add('lastName', TextType::class, [
                        'data' => $event->setData()
                    ])
                        ->add('email', EmailType::class, [
                            'data' => $event->setData()
                        ]);
                }
                else {
                    $form
                        ->add('author', HiddenType::class);
                }
            });

//            ->add('lastName', TextType::class)
//            ->add('email', EmailType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddCommentOnArticleDTO::class,
            'empty_data' => function(FormInterface $form) {
                            return new AddCommentOnArticleDTO(
                               $form->get('content')->getData(),
//                               $form->get('article')->getData(),
                               $this->tokenStorage->getToken()->getUser()
//                               $form->get('email')->getData(),
//                               $form->get('lastName')->getData()
                            );
                    }
        ]);
    }

}