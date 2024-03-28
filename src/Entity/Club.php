<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ClubRepository::class)]
class Club
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    #[Assert\Length(min:3, max: 60, minMessage:"Le nom du club doit comporter au moins 3 caractères.", maxMessage:"Le nom du club ne doit pas dépasser 60 caractères.")]
    private ?string $nom = null;

    #[ORM\Column(length: 60)]
    #[Assert\Length(min:2, max: 60, minMessage:"Le nom du Pays doit comporter au moins 2 caractères.", maxMessage:"Le nom du club ne doit pas dépasser 60 caractères.")]
    private ?string $pays = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\GreaterThanOrEqual(100000, message:"Le budget doit si situer entre 100K et 1M")]
    private ?int $budget = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToMany(targetEntity: Joueur::class, mappedBy: 'club')]
    private Collection $idClub;

    public function __construct()
    {
        return $this->createdAt = new \DateTimeImmutable();
        $this->idClub = new ArrayCollection();
    }

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

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(int $budget): static
    {
        $this->budget = $budget;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Joueur>
     */
    public function getIdClub(): Collection
    {
        return $this->idClub;
    }

    public function addIdClub(Joueur $idClub): static
    {
        if (!$this->idClub->contains($idClub)) {
            $this->idClub->add($idClub);
            $idClub->setClub($this);
        }

        return $this;
    }

    public function removeIdClub(Joueur $idClub): static
    {
        if ($this->idClub->removeElement($idClub)) {
            // set the owning side to null (unless already changed)
            if ($idClub->getClub() === $this) {
                $idClub->setClub(null);
            }
        }

        return $this;
    }
}
