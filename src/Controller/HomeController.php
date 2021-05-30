<?php


namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function __invoke(GameRepository $gameRepository)
    {
        $games = $gameRepository->findAllWithDownloads([
          'limit' => 5
        ]);

        return $this->render('home.html.twig', [
            'games' => $games
        ]);
    }

}