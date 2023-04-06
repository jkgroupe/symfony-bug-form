<?php

namespace App\Form;

use App\Dto\StepDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StepForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('probability', ChoiceType::class, [
                'choice_loader' => new CallbackChoiceLoader(function () {
                    $probabilities = [];

                    for ($i = 0; $i <= 10; $i++) {
                        $value = $i * 10;
                        $probabilities["{$value}%"] = $value;
                    }

                    return $probabilities;
                }),
            ])
            ->add('position', HiddenType::class, [
                'attr' => ['class' => 'position']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StepDto::class,
        ]);
    }
}