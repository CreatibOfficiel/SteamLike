<?php


namespace App\Controller\Category;

use App\Entity\Category;
use App\Entity\Game;
use App\Entity\User;
use App\Form\Category\CategoryType;
use App\Form\Game\GameType;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditCategoryController extends AbstractController
{

    /**
     * @Route("/edit-category/{id}", name="edit_category")
     */
    public function __invoke(Category $category, Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('category/edit.html.twig', [
            'form' => $form->createView(),
            'edit' => true
        ]);
    }

}