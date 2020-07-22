<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * TypeTrajet
 *
 * @ORM\Table(name="type_trajet")
 * @ORM\Entity
 */
class TypeTrajet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_type_trajet", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTypeTrajet;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lib_type_trajet", type="string", length=100, nullable=true)
     */
    private $libTypeTrajet;

    public function getIdTypeTrajet(): ?int
    {
        return $this->idTypeTrajet;
    }

    public function getLibTypeTrajet(): ?string
    {
        return $this->libTypeTrajet;
    }

    public function setLibTypeTrajet(?string $libTypeTrajet): self
    {
        $this->libTypeTrajet = $libTypeTrajet;

        return $this;
    }


}
