<?php

namespace App\Entity;

use App\Repository\AmisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AmisRepository::class)
 */
class Amis
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Personnages::class, mappedBy="amibff")
     */
    private $perso;

    public function __construct()
    {
        $this->perso = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Personnages>
     */
    public function getPersobff(): Collection
    {
        return $this->perso;
    }

    public function addPersobff(Personnages $perso): self
    {
        if (!$this->perso->contains($perso)) {
            $this->perso[] = $perso;
            $perso->setAmibff($this);
        }

        return $this;
    }

    public function removePersobff(Personnages $perso): self
    {
        if ($this->perso->removeElement($perso)) {
            // set the owning side to null (unless already changed)
            if ($perso->getAmibff() === $this) {
                $perso->setAmibff(null);
            }
        }

        return $this;
    }

}
