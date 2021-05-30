<?php


namespace App\Controller\Game;

use App\Entity\Game;
use App\Entity\User;
use App\Form\Game\GameType;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditGameController extends AbstractController
{

    /**
     * @Route("/edit-game/{id}", name="edit_game")
     */
    public function __invoke(Game $game, Request $request, EntityManagerInterface $entityManager)
    {
        if($game->getOwner() !== $this->getUser()) return $this->createNotFoundException('This game is not yours');
        $form = $this->createForm(GameType::class, $game);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('game/edit.html.twig', [
            'form' => $form->createView(),
            'edit' => true
        ]);
    }

}