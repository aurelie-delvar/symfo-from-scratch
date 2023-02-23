<?php

namespace App\Entity;

use App\Repository\QualidadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QualidadRepository::class)
 */
class Qualidad
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $adjectif;

    /**
     * @ORM\ManyToMany(targetEntity=Personnages::class, mappedBy="qualites")
     */
    private $personnages;

    public function __construct()
    {
        $this->personnages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdjectif(): ?string
    {
        return $this->adjectif;
    }

    public function setAdjectif(string $adjectif): self
    {
        $this->adjectif = $adjectif;

        return $this;
    }

    /**
     * @return Collection<int, Personnages>
     */
    public function getPersonnages(): Collection
    {
        return $this->personnages;
    }

    public function addPersonnage(Personnages $personnage): self
    {
        if (!$this->personnages->contains($personnage)) {
            $this->personnages[] = $personnage;
            $personnage->addQualite($this);
        }

        return $this;
    }

    public function removePersonnage(Personnages $personnage): self
    {
        if ($this->personnages->removeElement($personnage)) {
            $personnage->removeQualite($this);
        }

        return $this;
    }
}
