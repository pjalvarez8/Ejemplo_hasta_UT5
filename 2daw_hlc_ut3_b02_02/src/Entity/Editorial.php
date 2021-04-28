<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EditorialRepository")
 * @ORM\Table(name="editorial")
 */
class Editorial
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
     * @var string
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", unique=true)
     * @var string
     */
    private $cif;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string|null
     */
    private $direccionPostal;

    /**
     * @ORM\OneToMany(targetEntity="Libro", mappedBy="editorial")
     * @var Libro[]|Collection
     */
    private $libros;

    public function __construct()
    {
        $this->libros = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Editorial
     */
    public function setNombre(string $nombre): Editorial
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getCif(): string
    {
        return $this->cif;
    }

    /**
     * @param string $cif
     * @return Editorial
     */
    public function setCif(string $cif): Editorial
    {
        $this->cif = $cif;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDireccionPostal(): ?string
    {
        return $this->direccionPostal;
    }

    /**
     * @param string|null $direccionPostal
     * @return Editorial
     */
    public function setDireccionPostal(?string $direccionPostal): Editorial
    {
        $this->direccionPostal = $direccionPostal;
        return $this;
    }
}
