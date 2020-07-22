<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * CapaciteTaxi
 * @ORM\Table(name="capacite_taxi", indexes={@ORM\Index(name="fk_cap_taxi", columns={"id_ptaxi"})})
 * @ORM\Entity
 */
class CapaciteTaxi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_capacite_vehicule", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCapaciteVehicule;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nbplace_vehicule", type="integer", nullable=true)
     */
    private $nbplaceVehicule;

    /**
     * @var \PositionTaxi
     *
     * @ORM\ManyToOne(targetEntity="PositionTaxi")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ptaxi", referencedColumnName="id_ptaxi")
     * })
     */
    private $idPtaxi;

    public function getIdCapaciteVehicule(): ?int
    {
        return $this->idCapaciteVehicule;
    }

    public function getNbplaceVehicule(): ?int
    {
        return $this->nbplaceVehicule;
    }

    public function setNbplaceVehicule(?int $nbplaceVehicule): self
    {
        $this->nbplaceVehicule = $nbplaceVehicule;

        return $this;
    }

    public function getIdPtaxi(): ?PositionTaxi
    {
        return $this->idPtaxi;
    }

    public function setIdPtaxi(?PositionTaxi $idPtaxi): self
    {
        $this->idPtaxi = $idPtaxi;

        return $this;
    }


}
