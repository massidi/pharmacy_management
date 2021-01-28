<?php

namespace App\Form;

use App\Entity\Supplier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupplierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [

                'attr' => [
                    'placeholder' => 'Entrer le Nom du fournisseur',
                    'class' => 'form-group bmd-form-group',
                ]])
            ->add('address', TextType::class, [

                'attr' => [
                    'placeholder' => 'Entre l\'adrres du fournisseur',
                    'class' => 'form-group bmd-form-group ',
                ]])

            ->add('quantity_order', TextType::class, [

                'attr' => [
                    'placeholder' => 'Entrer your adrres',
                    'class' => 'form-group bmd-form-group',
                ]])
            ->add('amount', TextType::class, [

                'attr' => [
                    'placeholder' => 'Entrer your adrres',
                    'class' => 'form-group bmd-form-group ',
                ]])
            ->add('products', CollectionType::class, [
                'entry_type' => ProductType::class,
                'entry_options' => ['label' => false],
                'by_reference' => false,
                'allow_add' => true,
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Supplier::class,
        ]);
    }
}
