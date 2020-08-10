<?php

namespace App\Form;

use App\Entity\Villa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VillaType extends AbstractType
{

    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add("Address", TextType::class)
        ->add("price", IntegerType::class)
        ->add("gardenArea", IntegerType::class)
        ->add("area", IntegerType::class)
        ->add("edit", SubmitType::class, ["label" => "Edit"]);
    }

    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver)
    {
        $resolver->setDefault("data_class", Villa::class);
    }
}
