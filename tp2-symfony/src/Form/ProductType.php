<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du produit',
                'attr' => [
                    'placeholder' => 'Ex : Air Jordan 1 High',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Décris le produit en détail',
                    'rows' => 5,
                ],
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix (€)',
                'attr' => [
                    'placeholder' => 'Ex : 199.99',
                ],
            ])
            ->add('brand', TextType::class, [
                'label' => 'Marque',
                'attr' => [
                    'placeholder' => 'Ex : Nike',
                ],
            ])
            ->add('createdAt', DateTimeType::class, [
                'label' => 'Date de création',
                'widget' => 'single_text',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}