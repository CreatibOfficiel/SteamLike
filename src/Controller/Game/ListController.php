<?php


namespace App\Controller\Game;

use App\Entity\Game;
use App\Entity\User;
use App\Form\Game\GameType;
use App\Form\Game\SearchGameType;
use App\Repository\DownloadRepository;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListController extends AbstractController
{

    /**
     * @Route("/list-game", name="list_game")
     */
    public function __invoke(Request $request, GameRepository $gameRepository)
    {
        $form = $this->createForm(SearchGameType::class);
        $form->handleRequest($request);

        $games = $gameRepository->findAllWithDownloads($form->getData() ?? []);

        return $this->render('game/list.html.twig', [
            'games' => $games,
            'form' => $form->createView()
        ]);
    }

}