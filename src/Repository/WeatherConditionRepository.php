<?php

namespace App\Repository;

use App\Entity\WeatherCondition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WeatherCondition|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeatherCondition|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeatherCondition[]    findAll()
 * @method WeatherCondition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherConditionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeatherCondition::class);
    }
    public function add(WeatherCondition ...$weatherConditions): self
    {
        array_map(fn (WeatherCondition $weatherCondition) => $this->_em->persist($weatherCondition), $weatherConditions);

        return $this;
    }

    public function save(): void
    {
        $this->_em->flush();
    }
}
