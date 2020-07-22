<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * TypeConducteur
 *
 * @ORM\Table(name="type_conducteur")
 * @ORM\Entity
 */
class TypeConducteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_type_conducteur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTypeConducteur;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_type_prestataire", type="string", length=100, nullable=false)
     */
    private $libTypePrestataire;

    public function getIdTypeConducteur(): ?int
    {
        return $this->idTypeConducteur;
    }

    public function getLibTypePrestataire(): ?string
    {
        return $this->libTypePrestataire;
    }

    public function setLibTypePrestataire(string $libTypePrestataire): self
    {
        $this->libTypePrestataire = $libTypePrestataire;

        return $this;
    }


}
