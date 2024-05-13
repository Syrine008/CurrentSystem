<?php

namespace App\Entity;

use App\Repository\DeviseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeviseRepository::class)
 */
class Devise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $devise;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $nomDevise;

    /**
     * @ORM\Column(type="integer")
     */
    private $unité;

    /**
     * @ORM\OneToMany(targetEntity=Cours::class, mappedBy="devise")
     */
    private $cours;

    /**
     * @ORM\ManyToMany(targetEntity=Achat::class, mappedBy="devise")
     */
    private $achats;

    /**
     * @ORM\OneToMany(targetEntity=Achat::class, mappedBy="Devise")
     */
    private $no;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
        $this->achats = new ArrayCollection();
        $this->no = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDevise(): ?string
    {
        return $this->devise;
    }

    public function setDevise(?string $devise): self
    {
        $this->devise = $devise;

        return $this;
    }

    public function getNomDevise(): ?string
    {
        return $this->nomDevise;
    }

    public function setNomDevise(string $nomDevise): self
    {
        $this->nomDevise = $nomDevise;

        return $this;
    }

    public function getUnité(): ?int
    {
        return $this->unité;
    }

    public function setUnité(int $unité): self
    {
        $this->unité = $unité;

        return $this;
    }

    /**
     * @return Collection|Cours[]
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours[] = $cour;
            $cour->setDevise($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getDevise() === $this) {
                $cour->setDevise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Achat>
     */
    public function getAchats(): Collection
    {
        return $this->achats;
    }

    public function addAchat(Achat $achat): self
    {
        if (!$this->achats->contains($achat)) {
            $this->achats[] = $achat;
            $achat->addDevise($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): self
    {
        if ($this->achats->removeElement($achat)) {
            $achat->removeDevise($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Achat>
     */
    public function getNo(): Collection
    {
        return $this->no;
    }

    public function addNo(Achat $no): self
    {
        if (!$this->no->contains($no)) {
            $this->no[] = $no;
            $no->setDevise($this);
        }

        return $this;
    }

    public function removeNo(Achat $no): self
    {
        if ($this->no->removeElement($no)) {
            // set the owning side to null (unless already changed)
            if ($no->getDevise() === $this) {
                $no->setDevise(null);
            }
        }

        return $this;
    }
}

