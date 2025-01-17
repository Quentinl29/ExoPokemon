<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $pointsVie = null;

    #[ORM\Column]
    private ?int $pointsAttaque = null;

    #[ORM\Column]
    private ?int $pointsDefense = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPointsVie(): ?int
    {
        return $this->pointsVie;
    }

    public function setPointsVie(int $pointsVie): static
    {
        $this->pointsVie = $pointsVie;

        return $this;
    }

    public function getPointsAttaque(): ?int
    {
        return $this->pointsAttaque;
    }

    public function setPointsAttaque(int $pointsAttaque): static
    {
        $this->pointsAttaque = $pointsAttaque;

        return $this;
    }

    public function getPointsDefense(): ?int
    {
        return $this->pointsDefense;
    }

    public function setPointsDefense(int $pointsDefense): static
    {
        $this->pointsDefense = $pointsDefense;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
