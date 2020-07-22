<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * CapaciteVehecule
 *
 * @ORM\Table(name="capacite_vehecule", indexes={@ORM\Index(name="fk_capacite_vehecule_proposition", columns={"id_proposition"})})
 * @ORM\Entity
 */
class CapaciteVehecule
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nbplocupe", type="integer", nullable=true)
     */
    private $nbplocupe;

    /**
     * @var \PropositionTrajetConducteur
     *
     * @ORM\ManyToOne(targetEntity="PropositionTrajetConducteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proposition", referencedColumnName="id_proposition")
     * })
     */
    private $idProposition;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbplocupe(): ?int
    {
        return $this->nbplocupe;
    }

    public function setNbplocupe(?int $nbplocupe): self
    {
        $this->nbplocupe = $nbplocupe;

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
