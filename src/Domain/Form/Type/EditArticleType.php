<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 11/05/2018
 * Time: 18:34
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\EditArticleTypeDTO;
use App\Domain\Models\Benefit;
use App\Subscriber\EditSlugSubscriber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditArticleType extends AbstractType
{
    /**
     * @var EditSlugSubscriber
     */
    private $editSlugSubscriber;

    /**
     * EditArticleType constructor.
     * @param EditSlugSubscriber $editSlugSubscriber
     */
    public function __construct(EditSlugSubscriber $editSlugSubscriber)
    {
        $this->editSlugSubscriber = $editSlugSubscriber;
    }


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('content', TextareaType::class)
            ->add('online', CheckboxType::class, [
                'required' => false
            ])
            ->add('personnalButton', TextType::class)
            ->add('prestation', EntityType::class, [
                'class' => Benefit::class,
                'choice_label' => 'name'
            ])
        ->addEventSubscriber($this->editSlugSubscriber);
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EditArticleTypeDTO::class,
            'empty_data' => function(FormInterface $form) {
                            return new EditArticleTypeDTO(
                                       $form->get('title')->getData(),
                                       $form->get('content')->getData(),
                                       $form->get('online')->getData(),
                                       $form->get('personnalButton')->getData(),
                                       $form->get('prestation')->getData()
                                    );
                    }
        ]);
    }

}