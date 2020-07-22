<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * TaxiTypeCourse
 *
 * @ORM\Table(name="taxi_type_course")
 * @ORM\Entity
 */
class TaxiTypeCourse
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_type_cource", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTypeCource;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lib_course", type="string", length=255, nullable=true)
     */
    private $libCourse;

    public function getIdTypeCource(): ?int
    {
        return $this->idTypeCource;
    }

    public function getLibCourse(): ?string
    {
        return $this->libCourse;
    }

    public function setLibCourse(?string $libCourse): self
    {
        $this->libCourse = $libCourse;

        return $this;
    }


}
