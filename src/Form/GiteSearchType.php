<?php

namespace App\Form;

use App\Entity\GiteSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class GiteSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minSurface', IntegerType ::class, [
                'required'=> false,
                'label'=>'Surface minimum'
            ])
            ->add('maxBedrooms', IntegerType ::class, [
                'required'=> false,
                'label'=>'Nombre chambre maximum'
            ])

            ->add('animals', CheckboxType ::class, [
                'required'=> false,
                'label'=>'Animaux acceptés'
            ])
            
            ->add('submit', SubmitType ::class)

           
        ;
    
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GiteSearch::class,
            'method'=>'get',
            'csrf_protection'=> false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
