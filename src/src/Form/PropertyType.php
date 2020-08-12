<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("Address", TextType::class)
            ->add("price", IntegerType::class)
            ->add("area", IntegerType::class);

        if ($options["propertyType"] == "Villa")
            $builder->add("gardenArea", IntegerType::class);
        else if ($options["propertyType"] == "Apartment" || $options["propertyType"] == "Condo")
            $builder->add("balcony", ChoiceType::class, ["choices" => ["No" => 0, "Yes" => 1]]);

        $builder
            ->add("forSale", ChoiceType::class, ["choices" => ["No" => 0, "Yes" => 1]])
            ->add("edit", SubmitType::class, ["label" => "Submit"]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(["propertyType" => "Villa"]);
    }
}
