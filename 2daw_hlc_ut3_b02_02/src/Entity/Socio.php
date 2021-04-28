<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="socio")
 */
class Socio implements UserInterface
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
     * @ORM\Column(type="string")
     * @var string
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=9, nullable=true)
     * @var string|null
     */
    private $dni;

    // NOTA: Cuando la propiedad es booleana lo adecuado (si no nos dicen otra cosa) es
    // poner directamente lo que es, sin preceder de "es" o "tiene". En autor no lo
    // hemos hecho porque el enunciado pedía específicamente que la propiedad se llame
    // con el "es" delante

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $estudiante;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $docente;

    /**
     * @ORM\OneToMany(targetEntity="Libro", mappedBy="socio")
     * @var Libro[]|Collection
     */
    private $libros;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $clave;

    public function __toString()
    {
        return $this->getNombre() . ' ' . $this->getApellidos();
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
     * @return Socio
     */
    public function setNombre(string $nombre): Socio
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     * @return Socio
     */
    public function setApellidos(string $apellidos): Socio
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDni(): ?string
    {
        return $this->dni;
    }

    /**
     * @param string|null $dni
     * @return Socio
     */
    public function setDni(?string $dni): Socio
    {
        $this->dni = $dni;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEstudiante(): bool
    {
        return $this->estudiante;
    }

    /**
     * @param bool $estudiante
     * @return Socio
     */
    public function setEstudiante(bool $estudiante): Socio
    {
        $this->estudiante = $estudiante;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDocente(): bool
    {
        return $this->docente;
    }

    /**
     * @param bool $docente
     * @return Socio
     */
    public function setDocente(bool $docente): Socio
    {
        $this->docente = $docente;
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
     * @return Socio
     */
    public function setLibros($libros)
    {
        $this->libros = $libros;
        return $this;
    }

    /**
     * @return string
     */
    public function getClave(): string
    {
        return $this->clave;
    }

    /**
     * @param string $clave
     * @return Socio
     */
    public function setClave(string $clave): Socio
    {
        $this->clave = $clave;
        return $this;
    }

    public function getRoles()
    {
        $roles = ['ROLE_USER'];

        if ($this->isDocente()) {
            $roles[] = 'ROLE_DOCENTE';
        }
        if ($this->isEstudiante()) {
            $roles[] = 'ROLE_ESTUDIANTE';
        }

        return $roles;
    }

    public function getPassword()
    {
        return $this->clave;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->getDni();
    }

    public function eraseCredentials()
    {
    }
}
