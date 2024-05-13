<?php

namespace App\Entity;

use App\Repository\AchatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=AchatRepository::class)
 */
class Achat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_achat;

    /**
     * @ORM\Column(type="float")
     */
    private $montant_achat;

    /**
     * @ORM\Column(type="float")
     */
    private $montant_conversion;

    /**
     * @ORM\ManyToOne(targetEntity=Cours::class, inversedBy="no")
     */
    private $Cours;

    /**
     * @ORM\ManyToOne(targetEntity=Devise::class, inversedBy="no")
     */
    private $Devise;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="no")
     */
    private $Client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->date_achat;
    }

    public function setDateAchat(?\DateTimeInterface $date_achat): self
    {
        $this->date_achat = $date_achat;

        return $this;
    }

    public function getMontantAchat(): ?float
    {
        return $this->montant_achat;
    }

    public function setMontantAchat(float $montant_achat): self
    {
        $this->montant_achat = $montant_achat;

        return $this;
    }

    public function getMontantConversion(): ?float
    {
        return $this->montant_conversion;
    }

    public function setMontantConversion(float $montant_conversion): self
    {
        $this->montant_conversion = $montant_conversion;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->Cours;
    }

    public function setCours(?Cours $Cours): self
    {
        $this->Cours = $Cours;

        return $this;
    }

    public function getDevise(): ?Devise
    {
        return $this->Devise;
    }

    public function setDevise(?Devise $Devise): self
    {
        $this->Devise = $Devise;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->Client;
    }

    public function setClient(?Client $Client): self
    {
        $this->Client = $Client;

        return $this;
    }
}
