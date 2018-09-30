<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpotRepository")
 */
class Spot
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SPO_photo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SPO_accessibilite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $SPO_description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PhotoUser", mappedBy="PHO_id_spot")
     */
    private $photoUsers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentairesUser", mappedBy="COM_id_spot")
     */
    private $commentairesUsers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Signalement", mappedBy="SIG_id_spot")
     */
    private $signalement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="spots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $SPO_id_User;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Champignon", inversedBy="spots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $SPO_id_champi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SPO_longitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SPO_latitude;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Signalement", mappedBy="sig_id_spot_id", orphanRemoval=true)
     */
    private $signalements;

    public function __construct()
    {
        $this->photoUsers = new ArrayCollection();
        $this->commentairesUsers = new ArrayCollection();
        $this->signalements = new ArrayCollection();
        $this->signa = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSPOPhoto(): ?string
    {
        return $this->SPO_photo;
    }

    public function setSPOPhoto(?string $SPO_photo): self
    {
        $this->SPO_photo = $SPO_photo;

        return $this;
    }

    public function getSPOAccessibilite(): ?string
    {
        return $this->SPO_accessibilite;
    }

    public function setSPOAccessibilite(string $SPO_accessibilite): self
    {
        $this->SPO_accessibilite = $SPO_accessibilite;

        return $this;
    }

    public function getSPODescription(): ?string
    {
        return $this->SPO_description;
    }

    public function setSPODescription(?string $SPO_description): self
    {
        $this->SPO_description = $SPO_description;

        return $this;
    }

    /**
     * @return Collection|PhotoUser[]
     */
    public function getPhotoUsers(): Collection
    {
        return $this->photoUsers;
    }

    public function addPhotoUser(PhotoUser $photoUser): self
    {
        if (!$this->photoUsers->contains($photoUser)) {
            $this->photoUsers[] = $photoUser;
            $photoUser->setPHOIdSpot($this);
        }

        return $this;
    }

    public function removePhotoUser(PhotoUser $photoUser): self
    {
        if ($this->photoUsers->contains($photoUser)) {
            $this->photoUsers->removeElement($photoUser);
            // set the owning side to null (unless already changed)
            if ($photoUser->getPHOIdSpot() === $this) {
                $photoUser->setPHOIdSpot(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CommentairesUser[]
     */
    public function getCommentairesUsers(): Collection
    {
        return $this->commentairesUsers;
    }

    public function addCommentairesUser(CommentairesUser $commentairesUser): self
    {
        if (!$this->commentairesUsers->contains($commentairesUser)) {
            $this->commentairesUsers[] = $commentairesUser;
            $commentairesUser->setCOMIdSpot($this);
        }

        return $this;
    }

    public function removeCommentairesUser(CommentairesUser $commentairesUser): self
    {
        if ($this->commentairesUsers->contains($commentairesUser)) {
            $this->commentairesUsers->removeElement($commentairesUser);
            // set the owning side to null (unless already changed)
            if ($commentairesUser->getCOMIdSpot() === $this) {
                $commentairesUser->setCOMIdSpot(null);
            }
        }

        return $this;
    }

    public function getSPOIdUser(): ?User
    {
        return $this->SPO_id_User;
    }

    public function setSPOIdUser(?User $SPO_id_User): self
    {
        $this->SPO_id_User = $SPO_id_User;

        return $this;
    }

    public function getSPOIdChampi(): ?Champignon
    {
        return $this->SPO_id_champi;
    }

    public function setSPOIdChampi(?Champignon $SPO_id_champi): self
    {
        $this->SPO_id_champi = $SPO_id_champi;

        return $this;
    }

    public function getSPOLongitude(): ?string
    {
        return $this->SPO_longitude;
    }

    public function setSPOLongitude(string $SPO_longitude): self
    {
        $this->SPO_longitude = $SPO_longitude;

        return $this;
    }

    public function getSPOLatitude(): ?string
    {
        return $this->SPO_latitude;
    }

    public function setSPOLatitude(string $SPO_latitude): self
    {
        $this->SPO_latitude = $SPO_latitude;

        return $this;
    }

    /**
     * @return Collection|Signalement[]
     */
    public function getSignalements(): Collection
    {
        return $this->signalements;
    }

    public function addSignalement(Signalement $signalement): self
    {
        if (!$this->signalements->contains($signalement)) {
            $this->signalements[] = $signalement;
            $signalement->setSigIdSpotId($this);
        }

        return $this;
    }

    public function removeSignalement(Signalement $signalement): self
    {
        if ($this->signalements->contains($signalement)) {
            $this->signalements->removeElement($signalement);
            // set the owning side to null (unless already changed)
            if ($signalement->getSigIdSpotId() === $this) {
                $signalement->setSigIdSpotId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Signalement[]
     */
    public function getSigna(): Collection
    {
        return $this->signa;
    }

    public function addSigna(Signalement $signa): self
    {
        if (!$this->signa->contains($signa)) {
            $this->signa[] = $signa;
            $signa->setSIGIdSpot($this);
        }

        return $this;
    }

    public function removeSigna(Signalement $signa): self
    {
        if ($this->signa->contains($signa)) {
            $this->signa->removeElement($signa);
            // set the owning side to null (unless already changed)
            if ($signa->getSIGIdSpot() === $this) {
                $signa->setSIGIdSpot(null);
            }
        }

        return $this;
    }
}
