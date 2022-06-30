<?php
declare(strict_types=1);

namespace App\Form;

    use App\Entity\District;
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
                ->add(District::NAME_KEY, TextType::class)
                ->add(District::CITY_KEY, TextType::class)
                ->add(District::AREA_KEY, NumberType::class)
                ->add(District::POPULATION_KEY, IntegerType::class)
                ->add('save', SubmitType::class, ['label' => 'Add'])
                ->getForm();
        }
    }