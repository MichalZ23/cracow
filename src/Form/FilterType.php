<?php

namespace App\Form;

use App\Entity\District;
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
            ->add('filter', TextType::class, [
                'required' => false
            ])
            ->add('filterColumn', ChoiceType::class,
                [
                    'choices' =>
                        [
                            District::ID_KEY => District::ID_KEY,
                            District::CITY_KEY => District::CITY_KEY,
                            District::NAME_KEY => District::NAME_KEY,
                            District::AREA_KEY => District::AREA_KEY,
                            District::POPULATION_KEY => District::POPULATION_KEY
                        ],
                    'expanded' => true,
                    'data' => District::NAME_KEY
                ])
            ->add('sortColumn', ChoiceType::class,
                [
                    'choices' =>
                        [
                            District::ID_KEY => District::ID_KEY,
                            District::CITY_KEY => District::CITY_KEY,
                            District::NAME_KEY => District::NAME_KEY,
                            District::AREA_KEY => District::AREA_KEY,
                            District::POPULATION_KEY => District::POPULATION_KEY
                        ],
                    'expanded' => true,
                    'data' => District::ID_KEY
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