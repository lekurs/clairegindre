<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 24/04/2018
 * Time: 13:42
 */

namespace App\Domain\Form\Type;


use App\Domain\Models\Article;
use App\Domain\Models\Gallery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SelectPicturesForArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pictures', CollectionType::class, [
                'entry_type' => PictureEditType::class,
                'allow_delete' => true,
                'allow_add' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Gallery::class
        ]);
    }

}