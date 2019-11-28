<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehiculeRepository")
 */
class Vehicule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Modele", inversedBy="vehicules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $modele;

    /**
     * @ORM\Column(type="float")
     */
    private $ptac;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlaces;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $energie;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $norme;

    /**
     * @ORM\Column(type="integer")
     */
    private $critair;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getPtac(): ?float
    {
        return $this->ptac;
    }

    public function setPtac(float $ptac): self
    {
        $this->ptac = $ptac;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces(int $nbPlaces): self
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    public function getEnergie(): ?string
    {
        return $this->energie;
    }

    public function setEnergie(string $energie): self
    {
        $this->energie = $energie;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getNorme(): ?string
    {
        return $this->norme;
    }

    public function setNorme(string $norme): self
    {
        $this->norme = $norme;

        return $this;
    }

    public function getCritair(): ?int
    {
        return $this->critair;
    }

    public function setCritair(int $critair): self
    {
        $this->critair = $critair;

        return $this;
    }
}
