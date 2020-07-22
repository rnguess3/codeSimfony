<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * CorelationCmdeTaxiConducteur
 *
 * @ORM\Table(name="corelation_cmde_taxi_conducteur", indexes={@ORM\Index(name="fk_conducteur_cmde_taxi", columns={"id_conducteur"}), @ORM\Index(name="fk_cmde_taxi_conducteur", columns={"id_cmde_taxi"})})
 * @ORM\Entity
 */
class CorelationCmdeTaxiConducteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_taxi_cond", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTaxiCond;

    /**
     * @var \CmdeTaxiClient
     *
     * @ORM\ManyToOne(targetEntity="CmdeTaxiClient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cmde_taxi", referencedColumnName="id_cmde_taxi")
     * })
     */
    private $idCmdeTaxi;

    /**
     * @var \Conducteur
     *
     * @ORM\ManyToOne(targetEntity="Conducteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_conducteur", referencedColumnName="id_conducteur")
     * })
     */
    private $idConducteur;

    public function getIdTaxiCond(): ?int
    {
        return $this->idTaxiCond;
    }

    public function getIdCmdeTaxi(): ?CmdeTaxiClient
    {
        return $this->idCmdeTaxi;
    }

    public function setIdCmdeTaxi(?CmdeTaxiClient $idCmdeTaxi): self
    {
        $this->idCmdeTaxi = $idCmdeTaxi;

        return $this;
    }

    public function getIdConducteur(): ?Conducteur
    {
        return $this->idConducteur;
    }

    public function setIdConducteur(?Conducteur $idConducteur): self
    {
        $this->idConducteur = $idConducteur;

        return $this;
    }


}
