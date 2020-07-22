<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * Notation
 *
 * @ORM\Table(name="notation", indexes={@ORM\Index(name="fk_conducteur_note", columns={"id_conducteur"})})
 * @ORM\Entity
 */
class Notation
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
     * @ORM\Column(name="note", type="integer", nullable=true)
     */
    private $note = '0';

    /**
     * @var \Conducteur
     *
     * @ORM\ManyToOne(targetEntity="Conducteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_conducteur", referencedColumnName="id_conducteur")
     * })
     */
    private $idConducteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

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
