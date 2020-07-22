<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * ItineraireCmdeTaxi
 *
 * @ORM\Table(name="itineraire_cmde_taxi", indexes={@ORM\Index(name="fk_id_client_itineraire", columns={"id_client"}), @ORM\Index(name="fk_id_cmde_taxi_itineraire", columns={"id_cmde_taxi"})})
 * @ORM\Entity
 */
class ItineraireCmdeTaxi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_itineraire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idItineraire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="longitude_client", type="string", length=255, nullable=true)
     */
    private $longitudeClient;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latitude_client", type="string", length=255, nullable=true)
     */
    private $latitudeClient;

    /**
     * @var \Clients
     *
     * @ORM\ManyToOne(targetEntity="Clients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_client", referencedColumnName="id_client")
     * })
     */
    private $idClient;

    /**
     * @var \CmdeTaxiClient
     *
     * @ORM\ManyToOne(targetEntity="CmdeTaxiClient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cmde_taxi", referencedColumnName="id_cmde_taxi")
     * })
     */
    private $idCmdeTaxi;

    public function getIdItineraire(): ?int
    {
        return $this->idItineraire;
    }

    public function getLongitudeClient(): ?string
    {
        return $this->longitudeClient;
    }

    public function setLongitudeClient(?string $longitudeClient): self
    {
        $this->longitudeClient = $longitudeClient;

        return $this;
    }

    public function getLatitudeClient(): ?string
    {
        return $this->latitudeClient;
    }

    public function setLatitudeClient(?string $latitudeClient): self
    {
        $this->latitudeClient = $latitudeClient;

        return $this;
    }

    public function getIdClient(): ?Clients
    {
        return $this->idClient;
    }

    public function setIdClient(?Clients $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
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


}
