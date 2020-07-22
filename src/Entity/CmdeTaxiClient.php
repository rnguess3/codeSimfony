<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * CmdeTaxiClient
 *
 * @ORM\Table(name="cmde_taxi_client", indexes={@ORM\Index(name="fk_course_cmde_taxi", columns={"id_type_course"}), @ORM\Index(name="fk_cmde_conducteur", columns={"id_conducteur"}), @ORM\Index(name="fk_cmde_client_taxi", columns={"id_client"})})
 * @ORM\Entity
 */
class CmdeTaxiClient
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_cmde_taxi", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCmdeTaxi;

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=255, nullable=false)
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude_depart", type="string", length=255, nullable=false)
     */
    private $longitudeDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude_depart", type="string", length=255, nullable=false)
     */
    private $latitudeDepart;

    /**
     * @var string|null
     *
     * @ORM\Column(name="arriver", type="string", length=255, nullable=true)
     */
    private $arriver;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude_arriver", type="string", length=255, nullable=false)
     */
    private $longitudeArriver;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude_arriver", type="string", length=255, nullable=false)
     */
    private $latitudeArriver;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cout_trajet", type="float", precision=10, scale=0, nullable=true)
     */
    private $coutTrajet;

    /**
     * @var int
     *
     * @ORM\Column(name="nbplace_reserver", type="integer", nullable=false)
     */
    private $nbplaceReserver;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heur_depart", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $heurDepart = 'CURRENT_TIMESTAMP';

    /**
     * @var float|null
     *
     * @ORM\Column(name="cout_par_place", type="float", precision=10, scale=0, nullable=true)
     */
    private $coutParPlace = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="statut", type="integer", nullable=true)
     */
    private $statut = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="quartier_depart", type="string", length=100, nullable=true)
     */
    private $quartierDepart;

    /**
     * @var string|null
     *
     * @ORM\Column(name="quartier_arriver", type="string", length=100, nullable=true)
     */
    private $quartierArriver;

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
     * @var \Conducteur
     *
     * @ORM\ManyToOne(targetEntity="Conducteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_conducteur", referencedColumnName="id_conducteur")
     * })
     */
    private $idConducteur;

    /**
     * @var \TaxiTypeCourse
     *
     * @ORM\ManyToOne(targetEntity="TaxiTypeCourse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_course", referencedColumnName="id_type_cource")
     * })
     */
    private $idTypeCourse;

    public function getIdCmdeTaxi(): ?int
    {
        return $this->idCmdeTaxi;
    }

    public function getDepart(): ?string
    {
        return $this->depart;
    }

    public function setDepart(string $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    public function getLongitudeDepart(): ?string
    {
        return $this->longitudeDepart;
    }

    public function setLongitudeDepart(string $longitudeDepart): self
    {
        $this->longitudeDepart = $longitudeDepart;

        return $this;
    }

    public function getLatitudeDepart(): ?string
    {
        return $this->latitudeDepart;
    }

    public function setLatitudeDepart(string $latitudeDepart): self
    {
        $this->latitudeDepart = $latitudeDepart;

        return $this;
    }

    public function getArriver(): ?string
    {
        return $this->arriver;
    }

    public function setArriver(?string $arriver): self
    {
        $this->arriver = $arriver;

        return $this;
    }

    public function getLongitudeArriver(): ?string
    {
        return $this->longitudeArriver;
    }

    public function setLongitudeArriver(string $longitudeArriver): self
    {
        $this->longitudeArriver = $longitudeArriver;

        return $this;
    }

    public function getLatitudeArriver(): ?string
    {
        return $this->latitudeArriver;
    }

    public function setLatitudeArriver(string $latitudeArriver): self
    {
        $this->latitudeArriver = $latitudeArriver;

        return $this;
    }

    public function getCoutTrajet(): ?float
    {
        return $this->coutTrajet;
    }

    public function setCoutTrajet(?float $coutTrajet): self
    {
        $this->coutTrajet = $coutTrajet;

        return $this;
    }

    public function getNbplaceReserver(): ?int
    {
        return $this->nbplaceReserver;
    }

    public function setNbplaceReserver(int $nbplaceReserver): self
    {
        $this->nbplaceReserver = $nbplaceReserver;

        return $this;
    }

    public function getHeurDepart(): ?\DateTimeInterface
    {
        return $this->heurDepart;
    }

    public function setHeurDepart(?\DateTimeInterface $heurDepart): self
    {
        $this->heurDepart = $heurDepart;

        return $this;
    }

    public function getCoutParPlace(): ?float
    {
        return $this->coutParPlace;
    }

    public function setCoutParPlace(?float $coutParPlace): self
    {
        $this->coutParPlace = $coutParPlace;

        return $this;
    }

    public function getStatut(): ?int
    {
        return $this->statut;
    }

    public function setStatut(?int $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getQuartierDepart(): ?string
    {
        return $this->quartierDepart;
    }

    public function setQuartierDepart(?string $quartierDepart): self
    {
        $this->quartierDepart = $quartierDepart;

        return $this;
    }

    public function getQuartierArriver(): ?string
    {
        return $this->quartierArriver;
    }

    public function setQuartierArriver(?string $quartierArriver): self
    {
        $this->quartierArriver = $quartierArriver;

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

    public function getIdConducteur(): ?Conducteur
    {
        return $this->idConducteur;
    }

    public function setIdConducteur(?Conducteur $idConducteur): self
    {
        $this->idConducteur = $idConducteur;

        return $this;
    }

    public function getIdTypeCourse(): ?TaxiTypeCourse
    {
        return $this->idTypeCourse;
    }

    public function setIdTypeCourse(?TaxiTypeCourse $idTypeCourse): self
    {
        $this->idTypeCourse = $idTypeCourse;

        return $this;
    }


}
