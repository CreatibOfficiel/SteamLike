<?php


namespace App\Controller\Category;

use App\Entity\Category;
use App\Entity\Game;
use App\Entity\User;
use App\Form\Game\GameType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteCategoryController extends AbstractController
{

    /**
     * @Route("/delete-category/{id}", name="delete_category")
     */
    public function __invoke(Category $category, Request $request, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('dashboard');
    }

}