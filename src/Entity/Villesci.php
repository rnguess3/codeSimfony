<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource()
 * Villesci
 *
 * @ORM\Table(name="villesci")
 * @ORM\Entity
 */
class Villesci
{
    /**
     * @var string
     *
     * @ORM\Column(name="COL 1", type="string", length=8, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $col1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="specification", type="string", length=44, nullable=true)
     */
    private $specification;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=44, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="longitude", type="string", length=15, nullable=true)
     */
    private $longitude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latitude", type="string", length=15, nullable=true)
     */
    private $latitude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COL 6", type="string", length=15, nullable=true)
     */
    private $col6;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COL 7", type="string", length=15, nullable=true)
     */
    private $col7;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COL 8", type="string", length=15, nullable=true)
     */
    private $col8;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COL 9", type="string", length=15, nullable=true)
     */
    private $col9;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COL 10", type="string", length=15, nullable=true)
     */
    private $col10;

    public function getCol1(): ?string
    {
        return $this->col1;
    }

    public function getSpecification(): ?string
    {
        return $this->specification;
    }

    public function setSpecification(?string $specification): self
    {
        $this->specification = $specification;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getCol6(): ?string
    {
        return $this->col6;
    }

    public function setCol6(?string $col6): self
    {
        $this->col6 = $col6;

        return $this;
    }

    public function getCol7(): ?string
    {
        return $this->col7;
    }

    public function setCol7(?string $col7): self
    {
        $this->col7 = $col7;

        return $this;
    }

    public function getCol8(): ?string
    {
        return $this->col8;
    }

    public function setCol8(?string $col8): self
    {
        $this->col8 = $col8;

        return $this;
    }

    public function getCol9(): ?string
    {
        return $this->col9;
    }

    public function setCol9(?string $col9): self
    {
        $this->col9 = $col9;

        return $this;
    }

    public function getCol10(): ?string
    {
        return $this->col10;
    }

    public function setCol10(?string $col10): self
    {
        $this->col10 = $col10;

        return $this;
    }


}
