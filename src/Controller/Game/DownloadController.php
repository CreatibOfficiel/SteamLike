<?php


namespace App\Controller\Game;

use App\Entity\Download;
use App\Entity\Game;
use App\Entity\User;
use App\Form\Game\GameType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DownloadController extends AbstractController
{

    /**
     * @Route("/download-game/{id}", name="download_game")
     */
    public function __invoke(Game $game, EntityManagerInterface $entityManager)
    {
        $download = new Download();
        $download->setRelatedUser($this->getUser())
            ->setGame($game);

        $entityManager->persist($download);
        $entityManager->flush();

        return $this->redirect($game->getLink());
    }

}