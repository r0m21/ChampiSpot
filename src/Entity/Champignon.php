<?php

namespace App\Entity;

use App\Entity\Champignon;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChampignonRepository")
 */
class Champignon
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $CHA_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CHA_espece;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CHA_nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CHA_comestible;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Spot", mappedBy="SPO_id_champi", orphanRemoval=true)
     */
    private $spots;

    public function __construct()
    {
        $this->spots = new ArrayCollection();
    }

    public function getCHAId()
    {
        return $this->CHA_id;
    }

    public function getCHAEspece(): ?string
    {
        return $this->CHA_espece;
    }

    public function setCHAEspece(string $CHA_espece): self
    {
        $this->CHA_espece = $CHA_espece;

        return $this;
    }

    public function getCHANom(): ?string
    {
        return $this->CHA_nom;
    }

    public function setCHANom(string $CHA_nom): self
    {
        $this->CHA_nom = $CHA_nom;

        return $this;
    }

    public function getCHAComestible(): ?string
    {
        return $this->CHA_comestible;
    }

    public function setCHAComestible(string $CHA_comestible): self
    {
        $this->CHA_comestible = $CHA_comestible;

        return $this;
    }

    /**
     * @return Collection|Spot[]
     */
    public function getSpots(): Collection
    {
        return $this->spots;
    }

    public function addSpot(Spot $spot): self
    {
        if (!$this->spots->contains($spot)) {
            $this->spots[] = $spot;
            $spot->setSPOIdChampi($this);
        }

        return $this;
    }

    public function removeSpot(Spot $spot): self
    {
        if ($this->spots->contains($spot)) {
            $this->spots->removeElement($spot);
            // set the owning side to null (unless already changed)
            if ($spot->getSPOIdChampi() === $this) {
                $spot->setSPOIdChampi(null);
            }
        }

        return $this;
    }
}
