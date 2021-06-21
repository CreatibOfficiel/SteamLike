<?php


namespace App\Form\Game;


use App\Entity\Game;
use App\Entity\User;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SearchGameType extends AbstractType
{
    private array $categories;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categories = $categoryRepository->findAll();
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('search', null, [
                'label' => 'Nom du jeu',
                'required' => false,
            ])
            ->add('categories', ChoiceType::class, [
                'label' => 'Catégorie(s)',
                'required' => false,
                'multiple' => true,
                'choices' => $this->categories,
                'choice_value' => function ($val) {
                    return $val;
                },
                'choice_label' => function ($val) {
                    return $val->getName();
                },
                'attr' => [
                    'class' => 'select2'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}