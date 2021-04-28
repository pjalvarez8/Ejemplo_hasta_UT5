<?php

namespace App\Repository;

use App\Entity\Editorial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EditorialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Editorial::class);
    }

    public function findConMenos5Libros() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT e FROM App\Entity\Editorial e WHERE SIZE(e.libros) < 5')
                ->getResult();
    }

    public function findOrdenadasCantidadLibrosDescendiente() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT e FROM App\Entity\Editorial e ORDER BY SIZE(e.libros) DESC')
                ->getResult();
    }
}