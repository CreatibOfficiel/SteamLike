<?php


namespace App\Form\User;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, [
                'label' => 'Email',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('plainPassword', null, [
                'label' => 'Mot de passe',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('firstname', null, [
                'label' => 'Prénom',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('lastname', null, [
                'label' => 'Nom',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}