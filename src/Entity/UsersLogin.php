<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * UsersLogin
 *
 * @ORM\Table(name="users_login", indexes={@ORM\Index(name="fk_Users_Users_login", columns={"id_user"})})
 * @ORM\Entity
 */
class UsersLogin
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user_login", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUserLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="mot_de_pass", type="string", length=255, nullable=false)
     */
    private $motDePass;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_creation_compte", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateCreationCompte = 'CURRENT_TIMESTAMP';

    /**
     * @var int|null
     *
     * @ORM\Column(name="n_password", type="integer", nullable=true)
     */
    private $nPassword = '0';

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    public function getIdUserLogin(): ?int
    {
        return $this->idUserLogin;
    }

    public function getMotDePass(): ?string
    {
        return $this->motDePass;
    }

    public function setMotDePass(string $motDePass): self
    {
        $this->motDePass = $motDePass;

        return $this;
    }

    public function getDateCreationCompte(): ?\DateTimeInterface
    {
        return $this->dateCreationCompte;
    }

    public function setDateCreationCompte(?\DateTimeInterface $dateCreationCompte): self
    {
        $this->dateCreationCompte = $dateCreationCompte;

        return $this;
    }

    public function getNPassword(): ?int
    {
        return $this->nPassword;
    }

    public function setNPassword(?int $nPassword): self
    {
        $this->nPassword = $nPassword;

        return $this;
    }

    public function getIdUser(): ?Users
    {
        return $this->idUser;
    }

    public function setIdUser(?Users $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }


}
