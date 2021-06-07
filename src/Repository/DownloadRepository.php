<?php

namespace App\Repository;

use App\Entity\Download;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Download|null find($id, $lockMode = null, $lockVersion = null)
 * @method Download|null findOneBy(array $criteria, array $orderBy = null)
 * @method Download[]    findAll()
 * @method Download[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DownloadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Download::class);
    }

    public function findGameAndDownloads()
    {
        return $this->createQueryBuilder('d')
            ->select('d as download')
            ->join('d.game', 'game')
            ->addSelect('game')
            ->join('game.owner', 'owner')
            ->addSelect('COUNT(d.id) as downloads')
            ->groupBy('owner.id, game.id')
            ->getQuery()
            ->getResult();
    }
}
