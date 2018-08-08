<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentairesUserRepository")
 */
class CommentairesUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $COM_text;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commentairesUsers")
     */
    private $COM_id_user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Spot", inversedBy="commentairesUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $COM_id_spot;

    public function getId()
    {
        return $this->id;
    }

    public function getCOMText(): ?string
    {
        return $this->COM_text;
    }

    public function setCOMText(string $COM_text): self
    {
        $this->COM_text = $COM_text;

        return $this;
    }

    public function getCOMIdUser(): ?User
    {
        return $this->COM_id_user;
    }

    public function setCOMIdUser(?User $COM_id_user): self
    {
        $this->COM_id_user = $COM_id_user;

        return $this;
    }

    public function getCOMIdSpot(): ?Spot
    {
        return $this->COM_id_spot;
    }

    public function setCOMIdSpot(?Spot $COM_id_spot): self
    {
        $this->COM_id_spot = $COM_id_spot;

        return $this;
    }
}
