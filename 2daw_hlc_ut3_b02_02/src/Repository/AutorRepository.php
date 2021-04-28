<?php


namespace App\Repository;


use App\Entity\Autor;
use App\Entity\Libro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AutorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Autor::class);
    }

    public function findOrdenados() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT a FROM App\Entity\Autor a ORDER BY a.apellidos, a.nombre')
            ->getResult();
    }
}