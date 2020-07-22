<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * PropositionTrajetConducteur
 *
 * @ORM\Table(name="proposition_trajet_conducteur", indexes={@ORM\Index(name="fk_type_trajet", columns={"id_type_trajet"}), @ORM\Index(name="fk_conducteur_proposition", columns={"id_conducteur"})})
 * @ORM\Entity
 */
class PropositionTrajetConducteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_proposition", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProposition;

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=100, nullable=false)
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
     * @var string
     *
     * @ORM\Column(name="arriver", type="string", length=100, nullable=false)
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
     * @var float
     *
     * @ORM\Column(name="cout_trajet", type="float", precision=10, scale=0, nullable=false)
     */
    private $coutTrajet;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre_de_place", type="integer", nullable=false)
     */
    private $nombreDePlace;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="HS", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $hs = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="HD", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $hd = 'CURRENT_TIMESTAMP';

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
     * @var \TypeTrajet
     *
     * @ORM\ManyToOne(targetEntity="TypeTrajet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_trajet", referencedColumnName="id_type_trajet")
     * })
     */
    private $idTypeTrajet;

    public function getIdProposition(): ?int
    {
        return $this->idProposition;
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

    public function setArriver(string $arriver): self
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

    public function setCoutTrajet(float $coutTrajet): self
    {
        $this->coutTrajet = $coutTrajet;

        return $this;
    }

    public function getNombreDePlace(): ?int
    {
        return $this->nombreDePlace;
    }

    public function setNombreDePlace(int $nombreDePlace): self
    {
        $this->nombreDePlace = $nombreDePlace;

        return $this;
    }

    public function getHs(): ?\DateTimeInterface
    {
        return $this->hs;
    }

    public function setHs(?\DateTimeInterface $hs): self
    {
        $this->hs = $hs;

        return $this;
    }

    public function getHd(): ?\DateTimeInterface
    {
        return $this->hd;
    }

    public function setHd(?\DateTimeInterface $hd): self
    {
        $this->hd = $hd;

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

    public function getIdTypeTrajet(): ?TypeTrajet
    {
        return $this->idTypeTrajet;
    }

    public function setIdTypeTrajet(?TypeTrajet $idTypeTrajet): self
    {
        $this->idTypeTrajet = $idTypeTrajet;

        return $this;
    }


}
