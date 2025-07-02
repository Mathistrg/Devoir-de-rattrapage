<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 125)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Lunette>
     */
    #[ORM\OneToMany(targetEntity: Lunette::class, mappedBy: 'categorie')]
    private Collection $lunettes;

    public function __construct()
    {
        $this->lunettes = new ArrayCollection();
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

    /**
     * @return Collection<int, Lunette>
     */
    public function getLunettes(): Collection
    {
        return $this->lunettes;
    }

    public function addLunette(Lunette $lunette): static
    {
        if (!$this->lunettes->contains($lunette)) {
            $this->lunettes->add($lunette);
            $lunette->setCategorie($this);
        }

        return $this;
    }

    public function removeLunette(Lunette $lunette): static
    {
        if ($this->lunettes->removeElement($lunette)) {
            // set the owning side to null (unless already changed)
            if ($lunette->getCategorie() === $this) {
                $lunette->setCategorie(null);
            }
        }

        return $this;
    }
}
