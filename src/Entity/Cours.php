<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 * @Vich\Uploadable
 */
class Cours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $PrixAchat;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $PrixVente;

    /**
     * @ORM\ManyToOne(targetEntity=Devise::class, inversedBy="cours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $devise;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"}, nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity=Achat::class, mappedBy="cours")
     */
    private $achats;

    /**
     * @ORM\OneToMany(targetEntity=Achat::class, mappedBy="Cours")
     */
    private $no;

    public function __construct()
    {
        $this->achats = new ArrayCollection();
        $this->no = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixAchat(): ?float
    {
        return $this->PrixAchat;
    }

    public function setPrixAchat(?float $PrixAchat): self
    {
        $this->PrixAchat = $PrixAchat;

        return $this;
    }

    public function getPrixVente(): ?float
    {
        return $this->PrixVente;
    }

    public function setPrixVente(?float $PrixVente): self
    {
        $this->PrixVente = $PrixVente;

        return $this;
    }

    public function getDevise(): ?devise
    {
        return $this->devise;
    }

    public function setDevise(?devise $devise): self
    {
        $this->devise = $devise;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

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
            $achat->addCour($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): self
    {
        if ($this->achats->removeElement($achat)) {
            $achat->removeCour($this);
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
            $no->setCours($this);
        }

        return $this;
    }

    public function removeNo(Achat $no): self
    {
        if ($this->no->removeElement($no)) {
            // set the owning side to null (unless already changed)
            if ($no->getCours() === $this) {
                $no->setCours(null);
            }
        }

        return $this;
    }
}
