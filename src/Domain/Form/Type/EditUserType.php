<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/04/2018
 * Time: 14:06
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\EditUserDTO;
use App\Domain\DTO\Interfaces\EditUserDTOInterface;
use App\Subscriber\Interfaces\EditUserSlugSubscriberInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUserType extends AbstractType
{
    /**
     * @var EditUserSlugSubscriberInterface
     */
    private $editUserSlugSubscriber;

    /**
     * EditUserType constructor.
     * @param EditUserSlugSubscriberInterface $editUserSlugSubscriber
     */
    public function __construct(EditUserSlugSubscriberInterface $editUserSlugSubscriber)
    {
        $this->editUserSlugSubscriber = $editUserSlugSubscriber;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('lastName', TextType::class)
            ->add('email', EmailType::class)
            ->add('plainPassword', PasswordType::class, [
                'required' => false
            ])
            ->add('weddingDate', DateType::class, [
//                'widget' => 'single_text',
            ])
            ->add('online', CheckboxType::class, [
                'required' => false
            ])
            ->addEventSubscriber($this->editUserSlugSubscriber)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EditUserDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                                            return new EditUserDTO(
                                                $form->get('username')->getData(),
                                                $form->get('lastName')->getData(),
                                                $form->get('email')->getData(),
                                                $form->get('plainPassword')->getData(),
                                                $form->get('weddingDate')->getData(),
                                                $form->get('online')->getData()
                                            );
                                            }
        ]);
    }
}