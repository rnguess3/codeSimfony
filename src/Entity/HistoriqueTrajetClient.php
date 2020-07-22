<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * HistoriqueTrajetClient
 *
 * @ORM\Table(name="historique_trajet_client", indexes={@ORM\Index(name="fk_Conducteur_historique_trajet_client", columns={"id_conducteur"}), @ORM\Index(name="fk_Client_historique_trajet_clien", columns={"id_client"}), @ORM\Index(name="fk_type_trajet_historique_trajet_client", columns={"id_type_trajet"})})
 * @ORM\Entity
 */
class HistoriqueTrajetClient
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_historique_tajet", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idHistoriqueTajet;

    /**
     * @var string|null
     *
     * @ORM\Column(name="depart", type="string", length=100, nullable=true)
     */
    private $depart;

    /**
     * @var string|null
     *
     * @ORM\Column(name="longitude_depart", type="string", length=255, nullable=true)
     */
    private $longitudeDepart;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latitude_depart", type="string", length=255, nullable=true)
     */
    private $latitudeDepart;

    /**
     * @var string|null
     *
     * @ORM\Column(name="arriver", type="string", length=100, nullable=true)
     */
    private $arriver;

    /**
     * @var string|null
     *
     * @ORM\Column(name="longitude_arriver", type="string", length=255, nullable=true)
     */
    private $longitudeArriver;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latitude_arriver", type="string", length=255, nullable=true)
     */
    private $latitudeArriver;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cout_trajet", type="float", precision=10, scale=0, nullable=true)
     */
    private $coutTrajet;

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
     * @var \TypeTrajet
     *
     * @ORM\ManyToOne(targetEntity="TypeTrajet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_trajet", referencedColumnName="id_type_trajet")
     * })
     */
    private $idTypeTrajet;

    public function getIdHistoriqueTajet(): ?int
    {
        return $this->idHistoriqueTajet;
    }

    public function getDepart(): ?string
    {
        return $this->depart;
    }

    public function setDepart(?string $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    public function getLongitudeDepart(): ?string
    {
        return $this->longitudeDepart;
    }

    public function setLongitudeDepart(?string $longitudeDepart): self
    {
        $this->longitudeDepart = $longitudeDepart;

        return $this;
    }

    public function getLatitudeDepart(): ?string
    {
        return $this->latitudeDepart;
    }

    public function setLatitudeDepart(?string $latitudeDepart): self
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

    public function setLongitudeArriver(?string $longitudeArriver): self
    {
        $this->longitudeArriver = $longitudeArriver;

        return $this;
    }

    public function getLatitudeArriver(): ?string
    {
        return $this->latitudeArriver;
    }

    public function setLatitudeArriver(?string $latitudeArriver): self
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
