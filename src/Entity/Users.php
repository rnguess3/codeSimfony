<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ApiResource()
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="un_mail", columns={"mail"}), @ORM\UniqueConstraint(name="un_telephone", columns={"telephone"})})
 * @ORM\Entity
 */
class Users implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=100, nullable=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=100, nullable=false)
     */
    private $mail;

    /**
     * @ORM\Column(name="roles", type="string", length=255, nullable=true)
     */
     private $roles = [];

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
     private $password;


    public function getIdUser(): ?int
    {
        return $this->idUser;
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return array('ROLE_USER');
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
     public function getRoles()
     {
         $roles = $this->roles;
         return (array) $roles;
     }

     public function getPassword(): ?string
      {
        return $this->password;
    }
 
     public function setRoles(array $roles): self
     {
         $this->roles = $roles;
         return $this;
     }
 
     /**
      * Returns the salt that was originally used to encode the password.
      *
      * This can return null if the password was not encoded using a salt.
      *
      * @return string|null The salt
      */
     public function getSalt()
     {
         return null;
     }
 
     /**
      * Returns the username used to authenticate the user.
      *
      * @return string The username
      */
     public function getUsername()
     {
         return $this->mail;
 
     }
 
     /**
      * Removes sensitive data from the user.
      *
      * This is important if, at any given point, sensitive information like
      * the plain-text password is stored on this object.
      */
     public function eraseCredentials()
     {
     }

}
