<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $id_type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $id_file;

    /**
     * @ORM\Column(type="date")
     * @Assert\Type("\DateTimeInterface")
     */
    private $date_delivre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $num_pass;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Type("\DateTimeInterface")
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationalite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/^\d{1,8}$/",
     *     message="Le numéro de téléphone doit contenir uniquement des chiffres et avoir au maximum 8 chiffres."
     * )
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity=Achat::class, mappedBy="client")
     */
    private $achats;

    /**
     * @ORM\OneToMany(targetEntity=Achat::class, mappedBy="Client")
     */
    private $no;

    /**
     * @ORM\OneToMany(targetEntity=Vente::class, mappedBy="client")
     */
    private $ventes;

    public function __construct()
    {
        $this->achats = new ArrayCollection();
        $this->no = new ArrayCollection();
        $this->ventes = new ArrayCollection();
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

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getIdType(): ?string
    {
        return $this->id_type;
    }

    public function setIdType(string $id_type): self
    {
        $this->id_type = $id_type;

        return $this;
    }

    public function getIdFile(): ?string
    {
        return $this->id_file;
    }

    public function setIdFile(?string $id_file): self
    {
        $this->id_file = $id_file;

        return $this;
    }

    public function getDateDelivre(): ?\DateTimeInterface
    {
        return $this->date_delivre;
    }

    public function setDateDelivre(\DateTimeInterface $date_delivre): self
    {
        $this->date_delivre = $date_delivre;

        return $this;
    }

    public function getNumPass(): ?string
    {
        return $this->num_pass;
    }

    public function setNumPass(string $num_pass): self
    {
        $this->num_pass = $num_pass;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

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
            $achat->setClient($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): self
    {
        if ($this->achats->removeElement($achat)) {
            // set the owning side to null (unless already changed)
            if ($achat->getClient() === $this) {
                $achat->setClient(null);
            }
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
            $no->setClient($this);
        }

        return $this;
    }

    public function removeNo(Achat $no): self
    {
        if ($this->no->removeElement($no)) {
            // set the owning side to null (unless already changed)
            if ($no->getClient() === $this) {
                $no->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Vente>
     */
    public function getVentes(): Collection
    {
        return $this->ventes;
    }

    public function addVente(Vente $vente): self
    {
        if (!$this->ventes->contains($vente)) {
            $this->ventes[] = $vente;
            $vente->setClient($this);
        }

        return $this;
    }

    public function removeVente(Vente $vente): self
    {
        if ($this->ventes->removeElement($vente)) {
            // set the owning side to null (unless already changed)
            if ($vente->getClient() === $this) {
                $vente->setClient(null);
            }
        }

        return $this;
    }
}
