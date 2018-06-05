<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 20:39
 */

namespace App\Domain\Form\Type;


use App\Domain\DTO\AnswerMailDTO;
use App\Domain\DTO\Interfaces\AnswerMailDTOInterface;
use App\Subscriber\Interfaces\AnswerEmailSubscriberInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AnswerEmailType extends AbstractType
{
    /**
     * @var AnswerEmailSubscriberInterface
     */
    private $answerEmailSubscriber;

    /**
     * AnswerEmailType constructor.
     * @param AnswerEmailSubscriberInterface $answerEmailSubscriber
     */
    public function __construct(AnswerEmailSubscriberInterface $answerEmailSubscriber)
    {
        $this->answerEmailSubscriber = $answerEmailSubscriber;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', TextType::class)
            ->add('content', TextareaType::class, [
                'required' => false
            ])
            ->addEventSubscriber($this->answerEmailSubscriber);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AnswerMailDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                return new AnswerMailDTO(
                   $form->get('subject')->getData(),
                   $form->get('content')->getData()
                );
            }
        ]);
    }
}