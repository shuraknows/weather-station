<?php

namespace App\Repository;

use App\Entity\WeatherStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WeatherStation|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeatherStation|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeatherStation[]    findAll()
 * @method WeatherStation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherStationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeatherStation::class);
    }
}
