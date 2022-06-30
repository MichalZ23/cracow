<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class FilterType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('GET')
            ->add('filter', TextType::class)
            ->add('filterColumn', ChoiceType::class,
                [
                    'choices' =>
                        [
                            'id' => 'id',
                            'city' => 'city',
                            'name' => 'name',
                            'area' => 'area',
                            'population' => 'population'
                        ],
                    'expanded' => true,
                ])
            ->add('sortColumn', ChoiceType::class,
                [
                    'choices' =>
                        [
                            'id' => 'id',
                            'city' => 'city',
                            'name' => 'name',
                            'area' => 'area',
                            'population' => 'population'
                        ],
                    'expanded' => true,
                ])
            ->add('sortDirection', ChoiceType::class,
            [
                'choices' =>
                [
                    'ASC' => 'asc',
                    'DESC' => 'desc'
                ],
                'expanded' => true,
            ])
            ->add('submit', SubmitType::class, ['label' => 'submit'])
            ->getForm();
    }
}