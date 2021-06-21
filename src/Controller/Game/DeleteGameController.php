<?php


namespace App\Controller\Game;

use App\Entity\Game;
use App\Entity\User;
use App\Form\Game\GameType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteGameController extends AbstractController
{

    /**
     * @Route("/delete-game/{id}", name="delete_game")
     */
    public function __invoke(Game $game, Request $request, EntityManagerInterface $entityManager)
    {
        /** @var User $user */
        $user = $this->getUser();

        if($game->getOwner() !== $user){
            return $this->createAccessDeniedException("Ce jeu ne vous appartient pas !");
        }

        $entityManager->remove($game);
        $entityManager->flush();

        return $this->redirectToRoute('dashboard');
    }

}