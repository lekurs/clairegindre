<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 15:09
 */

namespace App\Type\Extension;


use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;

class PictureTypeExtension extends AbstractTypeExtension
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined([
            'picture_path',
            'picture_name',
        ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (isset($options['picture_path']) && isset($options['picture_name'])) {
            $parentData = $form->getParent()->getData();

            $imageUrl = null;
            $imageName = null;
            if (null !== $parentData) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $imageUrl = $accessor->getValue($parentData, $options['publicPath']);
                $imageName = $accessor->getValue($parentData, $options['pictureName']);
            }

            $view->vars['image_url'] = $imageUrl;
            $view->vars['image_name'] = $imageName;
        }
    }

    public function getExtendedType()
    {
        return FileType::class;
    }

}
