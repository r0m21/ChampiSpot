<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoUserRepository")
 */
class PhotoUser
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
    private $PHO_url;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="photoUsers")
     */
    private $PHO_id_user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Spot", inversedBy="photoUsers")
     */
    private $PHO_id_spot;

    public function getId()
    {
        return $this->id;
    }

    public function getPHOUrl(): ?string
    {
        return $this->PHO_url;
    }

    public function setPHOUrl(string $PHO_url): self
    {
        $this->PHO_url = $PHO_url;

        return $this;
    }

    public function getPHOIdUser(): ?User
    {
        return $this->PHO_id_user;
    }

    public function setPHOIdUser(?User $PHO_id_user): self
    {
        $this->PHO_id_user = $PHO_id_user;

        return $this;
    }

    public function getPHOIdSpot(): ?Spot
    {
        return $this->PHO_id_spot;
    }

    public function setPHOIdSpot(?Spot $PHO_id_spot): self
    {
        $this->PHO_id_spot = $PHO_id_spot;

        return $this;
    }
}
