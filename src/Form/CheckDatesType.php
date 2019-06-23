<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class CheckDatesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start_time', DateType::class ,['widget' => 'single_text', 'attr' => ['class' => 'js-datepicker form', 'min' => date('Y-m-d')]])
            ->add('end_time', DateType::class ,['widget' => 'single_text', 'attr' => ['class' => 'js-datepicker form', 'min' => date('Y-m-d')]])
            ->add('save', SubmitType::class, ['label' => 'Book now!'])
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
