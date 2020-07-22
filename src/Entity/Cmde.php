<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * Cmde
 *
 * @ORM\Table(name="cmde", indexes={@ORM\Index(name="fk_cmde_client", columns={"id_client"}), @ORM\Index(name="fk_type_cmde_cmde", columns={"id_type_cmde"}), @ORM\Index(name="fk_proposition_cmde_coovoiturage", columns={"id_proposition"})})
 * @ORM\Entity
 */
class Cmde
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_cmd", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCmd;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_conducteur", type="integer", nullable=true)
     */
    private $idConducteur;

    /**
     * @var int|null
     *
     * @ORM\Column(name="capacite_vehicule", type="integer", nullable=true)
     */
    private $capaciteVehicule = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="nbplaces_demande", type="integer", nullable=true)
     */
    private $nbplacesDemande = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="datecmde", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datecmde = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     *
     * @ORM\Column(name="nbkm", type="integer", nullable=false)
     */
    private $nbkm = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="nbminute", type="integer", nullable=false)
     */
    private $nbminute = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="montant_trajet", type="float", precision=10, scale=0, nullable=false)
     */
    private $montantTrajet;

    /**
     * @var int
     *
     * @ORM\Column(name="poid_marchandise", type="integer", nullable=false)
     */
    private $poidMarchandise = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="desc_marchandise", type="string", length=255, nullable=false, options={"default"="indisponible"})
     */
    private $descMarchandise = 'indisponible';

    /**
     * @var string|null
     *
     * @ORM\Column(name="localite_name", type="string", length=100, nullable=true, options={"default"="indisponible"})
     */
    private $localiteName = 'indisponible';

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
     * @var \PropositionTrajetConducteur
     *
     * @ORM\ManyToOne(targetEntity="PropositionTrajetConducteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proposition", referencedColumnName="id_proposition")
     * })
     */
    private $idProposition;

    /**
     * @var \TypeCmde
     *
     * @ORM\ManyToOne(targetEntity="TypeCmde")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_cmde", referencedColumnName="id_type_cmde")
     * })
     */
    private $idTypeCmde;

    public function getIdCmd(): ?int
    {
        return $this->idCmd;
    }

    public function getIdConducteur(): ?int
    {
        return $this->idConducteur;
    }

    public function setIdConducteur(?int $idConducteur): self
    {
        $this->idConducteur = $idConducteur;

        return $this;
    }

    public function getCapaciteVehicule(): ?int
    {
        return $this->capaciteVehicule;
    }

    public function setCapaciteVehicule(?int $capaciteVehicule): self
    {
        $this->capaciteVehicule = $capaciteVehicule;

        return $this;
    }

    public function getNbplacesDemande(): ?int
    {
        return $this->nbplacesDemande;
    }

    public function setNbplacesDemande(?int $nbplacesDemande): self
    {
        $this->nbplacesDemande = $nbplacesDemande;

        return $this;
    }

    public function getDatecmde(): ?\DateTimeInterface
    {
        return $this->datecmde;
    }

    public function setDatecmde(?\DateTimeInterface $datecmde): self
    {
        $this->datecmde = $datecmde;

        return $this;
    }

    public function getNbkm(): ?int
    {
        return $this->nbkm;
    }

    public function setNbkm(int $nbkm): self
    {
        $this->nbkm = $nbkm;

        return $this;
    }

    public function getNbminute(): ?int
    {
        return $this->nbminute;
    }

    public function setNbminute(int $nbminute): self
    {
        $this->nbminute = $nbminute;

        return $this;
    }

    public function getMontantTrajet(): ?float
    {
        return $this->montantTrajet;
    }

    public function setMontantTrajet(float $montantTrajet): self
    {
        $this->montantTrajet = $montantTrajet;

        return $this;
    }

    public function getPoidMarchandise(): ?int
    {
        return $this->poidMarchandise;
    }

    public function setPoidMarchandise(int $poidMarchandise): self
    {
        $this->poidMarchandise = $poidMarchandise;

        return $this;
    }

    public function getDescMarchandise(): ?string
    {
        return $this->descMarchandise;
    }

    public function setDescMarchandise(string $descMarchandise): self
    {
        $this->descMarchandise = $descMarchandise;

        return $this;
    }

    public function getLocaliteName(): ?string
    {
        return $this->localiteName;
    }

    public function setLocaliteName(?string $localiteName): self
    {
        $this->localiteName = $localiteName;

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

    public function getIdProposition(): ?PropositionTrajetConducteur
    {
        return $this->idProposition;
    }

    public function setIdProposition(?PropositionTrajetConducteur $idProposition): self
    {
        $this->idProposition = $idProposition;

        return $this;
    }

    public function getIdTypeCmde(): ?TypeCmde
    {
        return $this->idTypeCmde;
    }

    public function setIdTypeCmde(?TypeCmde $idTypeCmde): self
    {
        $this->idTypeCmde = $idTypeCmde;

        return $this;
    }


}
