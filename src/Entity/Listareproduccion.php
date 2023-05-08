<?php

namespace App\Entity;

use App\Repository\ListareproduccionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListareproduccionRepository::class)]
class Listareproduccion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'listareproduccions')]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Temazo::class, inversedBy: 'listareproduccions')]
    private Collection $canciones;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titulolista = null;

    public function __construct()
    {
        $this->canciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Temazo>
     */
    public function getCanciones(): Collection
    {
        return $this->canciones;
    }

    public function addCancione(Temazo $cancione): self
    {
        if (!$this->canciones->contains($cancione)) {
            $this->canciones->add($cancione);
        }

        return $this;
    }

    public function removeCancione(Temazo $cancione): self
    {
        $this->canciones->removeElement($cancione);

        return $this;
    }

    public function getTitulolista(): ?string
    {
        return $this->titulolista;
    }

    public function setTitulolista(?string $titulolista): self
    {
        $this->titulolista = $titulolista;

        return $this;
    }


    
}
