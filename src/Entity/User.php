<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 * fields = {"USE_email"},
 * message = "Cet email est déjà utilisée.",
 * )
 * @UniqueEntity(
 * fields = {"username"},
 * message = "Ce pseudo est déjà utilisé.",
 * )
 */
class User implements UserInterface
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
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $USE_nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $USE_email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire minimum 8 caractères")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Votre n'avez pas tapé le même mot de passe")
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $USE_role = 'ROLE_USER';

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PhotoUser", mappedBy="PHO_id_user")
     */
    private $photoUsers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentairesUser", mappedBy="COM_id_user")
     */
    private $commentairesUsers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Spot", mappedBy="SPO_id_User")
     */
    private $spots;

    public function __construct()
    {
        $this->photoUsers = new ArrayCollection();
        $this->commentairesUsers = new ArrayCollection();
        $this->spots = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getUSENom(): ?string
    {
        return $this->USE_nom;
    }

    public function setUSENom(string $USE_nom): self
    {
        $this->USE_nom = $USE_nom;

        return $this;
    }

    public function getUSEEmail(): ?string
    {
        return $this->USE_email;
    }

    public function setUSEEmail(string $USE_email): self
    {
        $this->USE_email = $USE_email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUSERole(): ?string
    {
        return $this->USE_role;
    }

    public function setUSERole(string $USE_role): self
    {
        $this->USE_role = $USE_role;

        return $this;
    }

    public function eraseCredentials(){}
    public function getSalt(){}

    /**
     * Returns the roles granted to the user.
     * 
     * @return Role[] The user roles
     */
    public function getRoles(){

        return array('ROLE_USER');
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
            $photoUser->setPHOIdUser($this);
        }

        return $this;
    }

    public function removePhotoUser(PhotoUser $photoUser): self
    {
        if ($this->photoUsers->contains($photoUser)) {
            $this->photoUsers->removeElement($photoUser);
            // set the owning side to null (unless already changed)
            if ($photoUser->getPHOIdUser() === $this) {
                $photoUser->setPHOIdUser(null);
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
            $commentairesUser->setCOMIdUser($this);
        }

        return $this;
    }

    public function removeCommentairesUser(CommentairesUser $commentairesUser): self
    {
        if ($this->commentairesUsers->contains($commentairesUser)) {
            $this->commentairesUsers->removeElement($commentairesUser);
            // set the owning side to null (unless already changed)
            if ($commentairesUser->getCOMIdUser() === $this) {
                $commentairesUser->setCOMIdUser(null);
            }
        }

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
            $spot->setSPOIdUser($this);
        }

        return $this;
    }

    public function removeSpot(Spot $spot): self
    {
        if ($this->spots->contains($spot)) {
            $this->spots->removeElement($spot);
            // set the owning side to null (unless already changed)
            if ($spot->getSPOIdUser() === $this) {
                $spot->setSPOIdUser(null);
            }
        }

        return $this;
    }
}
