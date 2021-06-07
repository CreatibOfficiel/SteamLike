<?php

namespace App\Repository;

use App\Entity\Download;
use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function findAllWithDownloads(array $criteria = [])
    {
        $subSelect = $this->_em->createQueryBuilder()
            ->select('COUNT(DISTINCT d.relatedUser)')
            ->from(Download::class, 'd')
            ->leftJoin('d.game', 'game2')
            ->where('game2 = g');

        $query = $this->createQueryBuilder('g')
            ->select('g as game')
            ->join('g.owner', 'owner')
            ->addSelect('(' . $subSelect->getDQL() . ') as downloads')
            ->addSelect('owner')
            ->orderBy('g.createdAt', 'DESC');
        if(isset($criteria['limit']) && is_int($criteria['limit'])) {
            $query->setMaxResults($criteria['limit']);
        }

        if(isset($criteria['search']) && '' !== $criteria['search']) {
            $query->andWhere('g.name LIKE :search')
                ->setParameter('search', '%' . $criteria['search'] . '%');
        }

        if(isset($criteria['category']) && is_array($criteria['category']) && count($criteria['category'])) {
            $query->andWhere('g.category IN (:categories)')
                ->setParameter('categories', $criteria['category']);

        }

        return $query->getQuery()
            ->getResult();;
    }
}
