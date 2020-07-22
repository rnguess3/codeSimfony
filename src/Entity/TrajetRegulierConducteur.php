<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * TrajetRegulierConducteur
 *
 * @ORM\Table(name="trajet_regulier_conducteur", indexes={@ORM\Index(name="fk_conducteur_trajet_regulier", columns={"id_conducteur"})})
 * @ORM\Entity
 */
class TrajetRegulierConducteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_trajet", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTrajet;

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=100, nullable=false)
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="logitude_depart", type="string", length=255, nullable=false)
     */
    private $logitudeDepart;

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
     * @ORM\Column(name="logitude_arriver", type="string", length=255, nullable=false)
     */
    private $logitudeArriver;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude_arriver", type="string", length=255, nullable=false)
     */
    private $latitudeArriver;

    /**
     * @var \Conducteur
     *
     * @ORM\ManyToOne(targetEntity="Conducteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_conducteur", referencedColumnName="id_conducteur")
     * })
     */
    private $idConducteur;

    public function getIdTrajet(): ?int
    {
        return $this->idTrajet;
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

    public function getLogitudeDepart(): ?string
    {
        return $this->logitudeDepart;
    }

    public function setLogitudeDepart(string $logitudeDepart): self
    {
        $this->logitudeDepart = $logitudeDepart;

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

    public function getLogitudeArriver(): ?string
    {
        return $this->logitudeArriver;
    }

    public function setLogitudeArriver(string $logitudeArriver): self
    {
        $this->logitudeArriver = $logitudeArriver;

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
