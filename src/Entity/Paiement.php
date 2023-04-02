<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $mode = null;

    #[ORM\Column]
    private ?int $montant = null;

    #[ORM\OneToMany(mappedBy: 'id_commande', targetEntity: Commande::class)]
    private Collection $id_commande;

    public function __construct()
    {
        $this->id_commande = new ArrayCollection();
    }

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMode(): ?string
    {
        return $this->mode;
    }

    public function setMode(string $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getIdCommande(): Collection
    {
        return $this->id_commande;
    }

    public function addIdCommande(Commande $idCommande): self
    {
        if (!$this->id_commande->contains($idCommande)) {
            $this->id_commande->add($idCommande);
            $idCommande->setIdCommande($this);
        }

        return $this;
    }

    public function removeIdCommande(Commande $idCommande): self
    {
        if ($this->id_commande->removeElement($idCommande)) {
            // set the owning side to null (unless already changed)
            if ($idCommande->getIdCommande() === $this) {
                $idCommande->setIdCommande(null);
            }
        }

        return $this;
       
    }

    public function __toString()
    {
        return 
        ( String )
            $this->getIdCommande();
        
    }


    
}
