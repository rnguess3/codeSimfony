<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * DocumentsUsers
 *
 * @ORM\Table(name="documents_users", indexes={@ORM\Index(name="fk_users_documents", columns={"id_user"}), @ORM\Index(name="fk_type_document_document", columns={"type_document"})})
 * @ORM\Entity
 */
class DocumentsUsers
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_documents", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDocuments;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url_document", type="string", length=255, nullable=true)
     */
    private $urlDocument;

    /**
     * @var \TypeDocuments
     *
     * @ORM\ManyToOne(targetEntity="TypeDocuments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_document", referencedColumnName="id_type_document")
     * })
     */
    private $typeDocument;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    public function getIdDocuments(): ?int
    {
        return $this->idDocuments;
    }

    public function getUrlDocument(): ?string
    {
        return $this->urlDocument;
    }

    public function setUrlDocument(?string $urlDocument): self
    {
        $this->urlDocument = $urlDocument;

        return $this;
    }

    public function getTypeDocument(): ?TypeDocuments
    {
        return $this->typeDocument;
    }

    public function setTypeDocument(?TypeDocuments $typeDocument): self
    {
        $this->typeDocument = $typeDocument;

        return $this;
    }

    public function getIdUser(): ?Users
    {
        return $this->idUser;
    }

    public function setIdUser(?Users $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }


}
