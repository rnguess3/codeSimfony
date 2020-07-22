<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * Conducteur
 *
 * @ORM\Table(name="conducteur", indexes={@ORM\Index(name="fk_Type_conducteur_Conducteur", columns={"id_type_conducteur"}), @ORM\Index(name="fk_Users_Conducteur", columns={"id_user"})})
 * @ORM\Entity
 */
class Conducteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_conducteur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idConducteur;

    /**
     * @var \TypeConducteur
     *
     * @ORM\ManyToOne(targetEntity="TypeConducteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_conducteur", referencedColumnName="id_type_conducteur")
     * })
     */
    private $idTypeConducteur;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    public function getIdConducteur(): ?int
    {
        return $this->idConducteur;
    }

    public function getIdTypeConducteur(): ?TypeConducteur
    {
        return $this->idTypeConducteur;
    }

    public function setIdTypeConducteur(?TypeConducteur $idTypeConducteur): self
    {
        $this->idTypeConducteur = $idTypeConducteur;

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
