<?php


namespace App\Form\Game;


use App\Entity\Game;
use App\Entity\User;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichFileType;

class GameType extends AbstractType
{
    private array $categories;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categories = $categoryRepository->findAll();
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom du jeu',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('link', UrlType::class, [
                'label' => 'Lien du jeu',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('description', null, [
                'label' => 'Description',
                'required' => false,
            ])
            ->add('imageFile', VichFileType::class, [
                'label' => 'Logo',
                'allow_delete' => false,
                'download_link' => false,
                'required' => false
            ])
            ->add('categories', ChoiceType::class, [
                'label' => 'Catégories',
                'required' => true,
                'choices' => $this->categories,
                'choice_label' => function($val) {
                    return $val->getName();
                },
                'choice_value' => function($val) {
                    return $val;
                },
                'multiple' => true,
                'constraints' => [
                    new NotBlank(),
                ],
                'attr' => [
                    'class' => 'select2'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}