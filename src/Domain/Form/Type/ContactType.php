<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/02/2018
 * Time: 11:42
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\ContactTypeDTO;
use App\Domain\DTO\Interfaces\ContactTypeDTOInterface;
use App\Domain\Models\Benefit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Nom :',
                'label_attr' => ['class' => 'label_contact'],
                'required' => true,
                ))
            ->add('firstname', TextType::class, array(
                'label' => 'Prénom :',
                'label_attr' => ['class' => 'label_contact'],
                'required' => true,
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Email :',
                'label_attr' => ['class' => 'label_contact'],
                'required' => true,
            ))
            ->add('phone', TelType::class, array(
                'label' => 'Téléphone',
                'label_attr' => ['class' => 'label_contact'],
                'required' => true,
            ))
            ->add('date', DateType::class, array(
                'label' => 'Date de l\'évenement',
                'label_attr' => ['class' => 'label_contact'],
                'widget' => 'single_text',
                'required' => true,
            ))
            ->add('place', TextType::class, array(
                'label' => 'Lieu de l\'évenement',
                'label_attr' => ['class' => 'label_contact'],
                'required' => true,
            ))
            ->add('howKnow', TextType::class, array(
                'label' => 'Comment m\'avez vous connu',
                'label_attr' => ['class' => 'label_contact'],
                'required' => true,
            ))
            ->add('event', EntityType::class, [
                'expanded' => true,
                'multiple' => true,
                'class' => Benefit::class,
                'label_attr' => ['class' => 'checkbox-label'],
                'choice_label' => 'name',
            ])
            ->add('details', TextareaType::class, array(
                'label' => 'Tous les détails de votre évènement m\'intéresse, le style de votre mariage, le nombre d\'invités, le type de cérémonie ...',
                'label_attr' => ['class' => 'label_contact'],
                'required' => true,
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactTypeDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
            return new ContactTypeDTO(
                $form->get('name')->getData(),
                $form->get('firstname')->getData(),
                $form->get('email')->getData(),
                $form->get('phone')->getData(),
                $form->get('date')->getData(),
                $form->get('place')->getData(),
                $form->get('howKnow')->getData(),
                $form->get('event')->getData()->toArray(),
                $form->get('details')->getData()
            );
            },
            'validation_groups' => ['contact_creation']
        ]);
    }
}
