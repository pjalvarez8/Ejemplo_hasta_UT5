<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AutorRepository")
 * @ORM\Table(name="autor")
 */
class Autor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(min="3", minMessage="Tiene que tener más de 3 caracteres")
     * @var string
     */
    private $nombre;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $apellidos;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\LessThan("now")
     * @var \DateTime
     */
    private $fechaNacimiento;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $esNacional;

    /**
     * @ORM\OneToOne(targetEntity="Autor")
     * @var Autor|null
     */
    private $pseudonimo;
    /**
     * @ORM\ManyToMany(targetEntity="Libro", mappedBy="autores")
     * @Assert\Count(min=1, max=3)
     * @var Libro[]|Collection
     */
    private $libros;

    public function __toString()
    {
        return $this->getNombre() . ' ' . $this->getApellidos();
    }


    public function __construct()
    {
        $this->libros = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Autor
     */
    public function setNombre(string $nombre): Autor
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     * @return Autor
     */
    public function setApellidos(string $apellidos): Autor
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getFechaNacimiento(): ?\DateTime
    {
        return $this->fechaNacimiento;
    }

    /**
     * @param \DateTime|null $fechaNacimiento
     * @return Autor
     */
    public function setFechaNacimiento(?\DateTime $fechaNacimiento): Autor
    {
        $this->fechaNacimiento = $fechaNacimiento;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isEsNacional(): ?bool
    {
        return $this->esNacional;
    }

    /**
     * @param bool $esNacional
     * @return Autor
     */
    public function setEsNacional(bool $esNacional): Autor
    {
        $this->esNacional = $esNacional;
        return $this;
    }

    /**
     * @return Autor|null
     */
    public function getPseudonimo(): ?Autor
    {
        return $this->pseudonimo;
    }

    /**
     * @param Autor|null $pseudonimo
     * @return Autor
     */
    public function setPseudonimo(?Autor $pseudonimo): Autor
    {
        $this->pseudonimo = $pseudonimo;
        return $this;
    }

    /**
     * @return Libro[]|Collection
     */
    public function getLibros()
    {
        return $this->libros;
    }

    /**
     * @param Libro[]|Collection $libros
     * @return Autor
     */
    public function setLibros($libros)
    {
        $this->libros = $libros;
        return $this;
    }
}