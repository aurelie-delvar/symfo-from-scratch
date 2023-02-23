<?php

namespace App\Entity;

use App\Repository\AmisRepository;
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
     * @ORM\OneToOne(targetEntity=Personnages::class, mappedBy="amibff", cascade={"persist", "remove"})
     */
    private $perso;

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

    public function getPerso(): ?Personnages
    {
        return $this->perso;
    }

    public function setPerso(Personnages $perso): self
    {
        // set the owning side of the relation if necessary
        if ($perso->getAmibff() !== $this) {
            $perso->setAmibff($this);
        }

        $this->perso = $perso;

        return $this;
    }
}
