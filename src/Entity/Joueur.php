<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: JoueurRepository::class)]
class Joueur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    #[Assert\Length(min:2, max: 40, minMessage:"Le nom doit comporter au moins 2 caractères.", maxMessage:"Le nom ne doit pas dépasser 40 caractères.")]
    #[Assert\NotBlank()]
    private ?string $firstName = null;

    #[ORM\Column(length: 40)]
    #[Assert\Length(min:2, max: 40, minMessage:"Le nom doit comporter au moins 2 caractères.", maxMessage:"Le nom ne doit pas dépasser 40 caractères.")]
    #[Assert\NotBlank()]
    private ?string $nom = null;

    #[ORM\Column]
    #[Assert\Positive()]
    #[Assert\GreaterThanOrEqual(15, message:"L'âge doit être supérieur à 14 ans" )]
    #[Assert\LessThanOrEqual(45, message:"L'âge doit être inférieur à 46 ans" )]
    #[Assert\NotBlank()]
    private ?int $age = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero()]
    #[Assert\GreaterThanOrEqual(0, message:"Le numéro doit se situer entre 0 et 99" )]
    #[Assert\LessThanOrEqual(99, message:"Le numéro doit se situer entre 0 et 99" )]
    #[Assert\NotBlank()]
    private ?int $numero = null;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $poste = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 40, nullable: true)]
    #[Assert\Length(min:2, max: 40, minMessage:"Le nom doit comporter au moins 2 caractères.", maxMessage:"Le nom ne doit pas dépasser 40 caractères.")]
    private ?string $nationalite = null;

    #[ORM\ManyToOne(inversedBy: 'idClub')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Club $club = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(?string $poste): static
    {
        $this->poste = $poste;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(?string $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): static
    {
        $this->club = $club;

        return $this;
    }
}
