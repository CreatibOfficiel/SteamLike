<?php


namespace App\Controller\Category;

use App\Entity\Category;
use App\Entity\Game;
use App\Entity\User;
use App\Form\Category\CategoryType;
use App\Form\Game\GameType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddCategoryController extends AbstractController
{

    /**
     * @Route("/add-category", name="add_category")
     */
    public function __invoke(Request $request, EntityManagerInterface $entityManager)
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('category/edit.html.twig', [
            'form' => $form->createView(),
            'edit' => false,
        ]);
    }

}