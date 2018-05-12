<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/04/2018
 * Time: 09:53
 */

namespace App\Domain\Form\Type;


use App\Domain\Models\Gallery;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SelectGalleryForArticleType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', EntityType::class, array(
                'class' => Gallery::class,
                'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('gallery')
                            ->where('gallery.article is null' );
                    },
                'choice_label' => 'title',
                'label_attr' => ['class' => 'sr-only',],
                'constraints' => [
                    new UniqueEntity(['fields' => 'id'])
                ]
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
//            'data_class' => Gallery::class,
        ]);
    }
}
