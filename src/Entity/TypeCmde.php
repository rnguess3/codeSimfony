<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * TypeCmde
 *
 * @ORM\Table(name="type_cmde")
 * @ORM\Entity
 */
class TypeCmde
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_type_cmde", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTypeCmde;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lib_type_cmde", type="string", length=100, nullable=true)
     */
    private $libTypeCmde;

    public function getIdTypeCmde(): ?int
    {
        return $this->idTypeCmde;
    }

    public function getLibTypeCmde(): ?string
    {
        return $this->libTypeCmde;
    }

    public function setLibTypeCmde(?string $libTypeCmde): self
    {
        $this->libTypeCmde = $libTypeCmde;

        return $this;
    }


}
