<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * TypeDocuments
 *
 * @ORM\Table(name="type_documents")
 * @ORM\Entity
 */
class TypeDocuments
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_type_document", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTypeDocument;

    /**
     * @var string|null
     *
     * @ORM\Column(name="libelle_type_document", type="string", length=255, nullable=true)
     */
    private $libelleTypeDocument;

    public function getIdTypeDocument(): ?int
    {
        return $this->idTypeDocument;
    }

    public function getLibelleTypeDocument(): ?string
    {
        return $this->libelleTypeDocument;
    }

    public function setLibelleTypeDocument(?string $libelleTypeDocument): self
    {
        $this->libelleTypeDocument = $libelleTypeDocument;

        return $this;
    }


}
