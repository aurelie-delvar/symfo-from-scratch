<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PersonnagesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PersonnagesRepository::class)
 */
class Personnages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * 
     * @Groups("browse_persos")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @NotBlank
     * 
     * @Groups("browse_persos")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $surnom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Url(
        message = "The url {{ value }} is not a valid url"
    )
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="personnages")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank
     */
    private $typeId;

    /**
     * @ORM\ManyToMany(targetEntity=Qualidad::class, inversedBy="personnages")
     * @Assert\NotBlank(
     *  message = "Ce champ ne peut être vide" )
     */
    private $qualites;

    /**
     * @ORM\ManyToOne(targetEntity=Amis::class, inversedBy="perso")
     */
    private $amibff;

    public function __construct()
    {
        $this->qualites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSurnom(): ?string
    {
        return $this->surnom;
    }

    public function setSurnom(?string $surnom): self
    {
        $this->surnom = $surnom;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTypeId(): ?Type
    {
        return $this->typeId;
    }

    public function setTypeId(?Type $typeId): self
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * @return Collection<int, Qualidad>
     */
    public function getQualites(): Collection
    {
        return $this->qualites;
    }

    public function addQualite(Qualidad $qualite): self
    {
        if (!$this->qualites->contains($qualite)) {
            $this->qualites[] = $qualite;
        }

        return $this;
    }

    public function removeQualite(Qualidad $qualite): self
    {
        $this->qualites->removeElement($qualite);

        return $this;
    }

    public function getAmibff(): ?Amis
    {
        return $this->amibff;
    }

    public function setAmibff(?Amis $amibff): self
    {
        $this->amibff = $amibff;

        return $this;
    }

}
