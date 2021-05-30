<?php


namespace App\Controller\Game;

use App\Entity\Game;
use App\Entity\User;
use App\Form\Game\GameType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddGameController extends AbstractController
{

    /**
     * @Route("/add-game", name="add_game")
     */
    public function __invoke(Request $request, EntityManagerInterface $entityManager)
    {
        /** @var User $user */
        $user = $this->getUser();
        $game = new Game();
        $game->setOwner($user);

        $form = $this->createForm(GameType::class, $game);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($game);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('game/edit.html.twig', [
            'form' => $form->createView(),
            'edit' => false,
        ]);
    }

}