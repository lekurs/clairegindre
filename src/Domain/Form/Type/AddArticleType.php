<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:10
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\ArticleCreationDTO;
use App\Domain\DTO\Interfaces\ArticleCreationDTOInterface;
use App\Domain\Models\Benefit;
use App\Domain\Models\Gallery;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('gallery', EntityType::class, [
                'class' => Gallery::class,
                'choice_label' => 'title'
            ])
            ->add('content', TextareaType::class, [
                'required' => false
            ])
            ->add('personnalButton', TextType::class)
            ->add('online', CheckboxType::class)
            ->add('prestation', EntityType::class, [
                'class' => Benefit::class,
                'choice_label' => 'name',
                'label_attr' => ['class' => 'sr-only',],
                'constraints' => [
                    new UniqueEntity(['fields' => 'id'])
                    ]
            ])
//            ->add('images', CollectionType::class, [
//                'entry_type' => PictureEditType::class,
//                'allow_add'=> true,
//                'allow_delete' => true
//            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => ArticleCreationDTOInterface::class,
                'empty_data' => function (FormInterface $form) {
                                return new ArticleCreationDTO(
                                    $form->get('title')->getData(),
                                    $form->get('content')->getData(),
                                    $form->get('personnalButton')->getData(),
                                    $form->get('gallery')->getData(),
                                    $form->get('online')->getData(),
                                    $form->get('prestation')->getData()
                                );
                }
            ]);
    }
}
