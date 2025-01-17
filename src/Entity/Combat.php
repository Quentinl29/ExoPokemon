<?php

namespace App\Entity;

use App\Repository\CombatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CombatRepository::class)]
class Combat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Pokemon $Pokemon1 = null;

    #[ORM\ManyToOne]
    private ?Pokemon $pokemon2 = null;

    #[ORM\Column]
    private ?int $nbrTours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPokemon1(): ?Pokemon
    {
        return $this->Pokemon1;
    }

    public function setPokemon1(?Pokemon $Pokemon1): static
    {
        $this->Pokemon1 = $Pokemon1;

        return $this;
    }

    public function getPokemon2(): ?Pokemon
    {
        return $this->pokemon2;
    }

    public function setPokemon2(?Pokemon $pokemon2): static
    {
        $this->pokemon2 = $pokemon2;

        return $this;
    }

    public function getNbrTours(): ?int
    {
        return $this->nbrTours;
    }

    public function setNbrTours(int $nbrTours): static
    {
        $this->nbrTours = $nbrTours;

        return $this;
    }
}
