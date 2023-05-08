<?php

namespace App\Entity;

use App\Repository\TemazoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TemazoRepository::class)]
class Temazo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $autor = null;

    #[ORM\Column(nullable: true)]
    private ?int $duracion = null;

    #[ORM\ManyToMany(targetEntity: Listareproduccion::class, mappedBy: 'canciones')]
    private Collection $listareproduccions;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $archivenamesong = null;

    public function __construct()
    {
        $this->listareproduccions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(?string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getDuracion(): ?int
    {
        return $this->duracion;
    }

    public function setDuracion(?int $duracion): self
    {
        $this->duracion = $duracion;

        return $this;
    }

    /**
     * @return Collection<int, Listareproduccion>
     */
    public function getListareproduccions(): Collection
    {
        return $this->listareproduccions;
    }

    public function addListareproduccion(Listareproduccion $listareproduccion): self
    {
        if (!$this->listareproduccions->contains($listareproduccion)) {
            $this->listareproduccions->add($listareproduccion);
            $listareproduccion->addCancione($this);
        }

        return $this;
    }

    public function removeListareproduccion(Listareproduccion $listareproduccion): self
    {
        if ($this->listareproduccions->removeElement($listareproduccion)) {
            $listareproduccion->removeCancione($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->titulo;
    
    }

    public function getArchivenamesong(): ?string
    {
        return $this->archivenamesong;
    }

    public function setArchivenamesong(?string $archivenamesong): self
    {
        $this->archivenamesong = $archivenamesong;

        return $this;
    }
}
