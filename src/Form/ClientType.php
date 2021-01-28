<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [

                'attr' => [
                    'placeholder' => 'Entrer le Nom du client',
                    'class' => 'form-group bmd-form-group',
                ]])
            ->add('address', TextType::class, [

                'attr' => [
                    'placeholder' => 'Entrer l\'adresse du 1 client',
                    'class' => 'form-group bmd-form-group',
                ]])
            ->add('paymentMode', ChoiceType::class, [
                'placeholder' => 'Selecte Type de payment',
                'choices' => [
                    'Cash' => 'Cash',
                    'Cart' =>'Cart',
                    'Orange Money' => 'Orange Money',
                ],
                'attr' => [
                    'class' => 'form-group bmd-form-group',
                ]])
            ->add('email', TextType::class, [

                'attr' => [
                    'placeholder' => 'Entrer le l\'email du client',
                    'class' => 'form-group bmd-form-group',
                ]])
            ->add('phone_number', TextType::class, [
                 'label'=>false,
                'attr' => [
                    'placeholder' => 'Entrer le numero de tel.  client',
                    'class' => 'form-group bmd-form-group',
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
