<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * StatutClim
 *
 * @ORM\Table(name="statut_clim")
 * @ORM\Entity
 */
class StatutClim
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_statut_clim", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStatutClim;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lib_statut_clim", type="string", length=255, nullable=true)
     */
    private $libStatutClim;

    public function getIdStatutClim(): ?int
    {
        return $this->idStatutClim;
    }

    public function getLibStatutClim(): ?string
    {
        return $this->libStatutClim;
    }

    public function setLibStatutClim(?string $libStatutClim): self
    {
        $this->libStatutClim = $libStatutClim;

        return $this;
    }


}
