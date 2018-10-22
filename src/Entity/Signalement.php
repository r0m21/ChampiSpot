<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SignalementRepository")
 */
class Signalement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SIG_vide;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SIG_toxique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SIG_desc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SIG_accessibilite;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="signalements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $SIG_id_user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Spot", inversedBy="spot_id_sig")
     * @ORM\JoinColumn(nullable=false)
     */
    private $spot;

    public function getId()
    {
        return $this->id;
    }

    public function getSIGVide(): ?string
    {
        return $this->SIG_vide;
    }

    public function setSIGVide(string $SIG_vide): self
    {
        $this->SIG_vide = $SIG_vide;

        return $this;
    }

    public function getSIGToxique(): ?string
    {
        return $this->SIG_toxique;
    }

    public function setSIGToxique(string $SIG_toxique): self
    {
        $this->SIG_toxique = $SIG_toxique;

        return $this;
    }

    public function getSIGDesc(): ?string
    {
        return $this->SIG_desc;
    }

    public function setSIGDesc(string $SIG_desc): self
    {
        $this->SIG_desc = $SIG_desc;

        return $this;
    }

    public function getSIGAccessibilite(): ?string
    {
        return $this->SIG_accessibilite;
    }

    public function setSIGAccessibilite(string $SIG_accessibilite): self
    {
        $this->SIG_accessibilite = $SIG_accessibilite;

        return $this;
    }


    public function getSIGIdUser(): ?User
    {
        return $this->SIG_id_user;
    }

    public function setSIGIdUser(?User $SIG_id_user): self
    {
        $this->SIG_id_user = $SIG_id_user;

        return $this;
    }

    public function getSpot(): ?Spot
    {
        return $this->spot;
    }

    public function setSpot(?Spot $spot): self
    {
        $this->spot = $spot;

        return $this;
    }

}
