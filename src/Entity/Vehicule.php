<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * Vehicule
 *
 * @ORM\Table(name="vehicule", indexes={@ORM\Index(name="fk_statut_clim", columns={"id_statut_clim"}), @ORM\Index(name="fk_conducteur_vehicule", columns={"id_conducteur"})})
 * @ORM\Entity
 */
class Vehicule
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_vehicule", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVehicule;

    /**
     * @var string
     *
     * @ORM\Column(name="imatriculation_vehicule", type="string", length=100, nullable=false)
     */
    private $imatriculationVehicule;

    /**
     * @var string|null
     *
     * @ORM\Column(name="marque_vehicule", type="string", length=100, nullable=true)
     */
    private $marqueVehicule;

    /**
     * @var string|null
     *
     * @ORM\Column(name="model_vehicule", type="string", length=100, nullable=true)
     */
    private $modelVehicule;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url_photo_vehicule", type="string", length=100, nullable=true)
     */
    private $urlPhotoVehicule;

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
     * @var \StatutClim
     *
     * @ORM\ManyToOne(targetEntity="StatutClim")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_statut_clim", referencedColumnName="id_statut_clim")
     * })
     */
    private $idStatutClim;

    public function getIdVehicule(): ?int
    {
        return $this->idVehicule;
    }

    public function getImatriculationVehicule(): ?string
    {
        return $this->imatriculationVehicule;
    }

    public function setImatriculationVehicule(string $imatriculationVehicule): self
    {
        $this->imatriculationVehicule = $imatriculationVehicule;

        return $this;
    }

    public function getMarqueVehicule(): ?string
    {
        return $this->marqueVehicule;
    }

    public function setMarqueVehicule(?string $marqueVehicule): self
    {
        $this->marqueVehicule = $marqueVehicule;

        return $this;
    }

    public function getModelVehicule(): ?string
    {
        return $this->modelVehicule;
    }

    public function setModelVehicule(?string $modelVehicule): self
    {
        $this->modelVehicule = $modelVehicule;

        return $this;
    }

    public function getUrlPhotoVehicule(): ?string
    {
        return $this->urlPhotoVehicule;
    }

    public function setUrlPhotoVehicule(?string $urlPhotoVehicule): self
    {
        $this->urlPhotoVehicule = $urlPhotoVehicule;

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

    public function getIdStatutClim(): ?StatutClim
    {
        return $this->idStatutClim;
    }

    public function setIdStatutClim(?StatutClim $idStatutClim): self
    {
        $this->idStatutClim = $idStatutClim;

        return $this;
    }


}
