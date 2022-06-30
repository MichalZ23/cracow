<?php

namespace App\Form;

    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\NumberType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;

    class DistrictType extends \Symfony\Component\Form\AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('name', TextType::class)
                ->add('city', TextType::class)
                ->add('area', NumberType::class)
                ->add('population', IntegerType::class)
                ->add('save', SubmitType::class, ['label' => 'Add'])
                ->getForm();
        }
    }