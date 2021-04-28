<?php


namespace App\Repository;


use App\Entity\Libro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LibroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Libro::class);
    }

    public function findOrdenadosTitulo() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT l FROM App\Entity\Libro l ORDER BY l.titulo')
            ->getResult();
    }

    public function findOrdenadosAnioDescendente() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT l FROM App\Entity\Libro l ORDER BY l.anioPublicacion DESC')
            ->getResult();
    }

    public function findPorPalabraTitulo(string $palabra) : array
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT l FROM App\Entity\Libro l WHERE l.titulo LIKE :palabra')
            ->setParameter('palabra', '%' . $palabra . '%')
            ->getResult();
    }

    public function findPorPalabraEditorial(string $palabra) : array
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT l FROM App\Entity\Libro l JOIN l.editorial e WHERE e.nombre LIKE :palabra')
            ->setParameter('palabra', '%' . $palabra . '%')
            ->getResult();
    }

    public function findNoPrestados() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT l FROM App\Entity\Libro l WHERE l.socio IS NULL')
            ->getResult();
    }

    public function findUnSoloAutor() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT l FROM App\Entity\Libro l WHERE SIZE(l.autores) = 1')
            ->getResult();
    }
}