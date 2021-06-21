<?php


namespace App\Controller\Game;

use App\Entity\Game;
use App\Entity\User;
use App\Form\Game\GameType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetailsGameController extends AbstractController
{

    /**
     * @Route("/details-game/{id}", name="details_game")
     */
    public function __invoke(Game $game)
    {
        return $this->render('game/details.html.twig', [
            "game"=>$game
        ]);
    }

}