<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * ItineraireTrajet
 *
 * @ORM\Table(name="itineraire_trajet", indexes={@ORM\Index(name="fk_itineraire_proposition", columns={"id_proposition"})})
 * @ORM\Entity
 */
class ItineraireTrajet
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
     * @ORM\Column(name="lib_itineraire", type="string", length=100, nullable=true)
     */
    private $libItineraire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="logitude_itineraire", type="string", length=100, nullable=true)
     */
    private $logitudeItineraire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latitude_itineraire", type="string", length=100, nullable=true)
     */
    private $latitudeItineraire;

    /**
     * @var \PropositionTrajetConducteur
     *
     * @ORM\ManyToOne(targetEntity="PropositionTrajetConducteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proposition", referencedColumnName="id_proposition")
     * })
     */
    private $idProposition;

    public function getIdItineraire(): ?int
    {
        return $this->idItineraire;
    }

    public function getLibItineraire(): ?string
    {
        return $this->libItineraire;
    }

    public function setLibItineraire(?string $libItineraire): self
    {
        $this->libItineraire = $libItineraire;

        return $this;
    }

    public function getLogitudeItineraire(): ?string
    {
        return $this->logitudeItineraire;
    }

    public function setLogitudeItineraire(?string $logitudeItineraire): self
    {
        $this->logitudeItineraire = $logitudeItineraire;

        return $this;
    }

    public function getLatitudeItineraire(): ?string
    {
        return $this->latitudeItineraire;
    }

    public function setLatitudeItineraire(?string $latitudeItineraire): self
    {
        $this->latitudeItineraire = $latitudeItineraire;

        return $this;
    }

    public function getIdProposition(): ?PropositionTrajetConducteur
    {
        return $this->idProposition;
    }

    public function setIdProposition(?PropositionTrajetConducteur $idProposition): self
    {
        $this->idProposition = $idProposition;

        return $this;
    }


}
