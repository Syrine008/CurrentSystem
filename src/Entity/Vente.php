<?php

namespace App\Entity;

use App\Repository\VenteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VenteRepository::class)
 */
class Vente
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
    private $date_vente;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $montant_vente;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $montant_conversion;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="ventes")
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateVente(): ?\DateTimeInterface
    {
        return $this->date_vente;
    }

    public function setDateVente(?\DateTimeInterface $date_vente): self
    {
        $this->date_vente = $date_vente;

        return $this;
    }

    public function getMontantVente(): ?float
    {
        return $this->montant_vente;
    }

    public function setMontantVente(?float $montant_vente): self
    {
        $this->montant_vente = $montant_vente;

        return $this;
    }

    public function getMontantConversion(): ?float
    {
        return $this->montant_conversion;
    }

    public function setMontantConversion(?float $montant_conversion): self
    {
        $this->montant_conversion = $montant_conversion;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
