<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 14/02/2018
 * Time: 15:53
 */

namespace App\Type;


use App\Entity\Reviews;
use App\Subscriber\ReviewImageSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewsType extends AbstractType
{
    /**
     * @var ReviewImageSubscriber
     */
    private $reviewImageSubscriber;

    public function __construct(ReviewImageSubscriber $imageSubscriber)
    {
        $this->reviewImageSubscriber = $imageSubscriber;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Nom du client',
                'required' => true,
            ))
        ->add('image', FileType::class, array(
            'label' => 'Choisissez votre image',
        ))
            ->add('reviews', TextareaType::class, array(
                'label' => 'Avis client',
                'attr' => ['id' => 'reviews', 'class' => 'form-control']
            ))
            ->add('online', ChoiceType::class, array(
                'choices' => array(
                    'online' => true,
                    'offline' => false,
                ),
                'expanded' => true,
                'multiple' => false,
                'attr' => ['class' => 'btn btn-primary btn-sm active'],

            ))
            ;

        $builder->get("image")->addEventSubscriber($this->reviewImageSubscriber);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Reviews::class,
        ));
    }

}