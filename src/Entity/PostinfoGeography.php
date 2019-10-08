<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostinfoGeography
 *
 * @ORM\Table(name="postinfo_geography")
 * @ORM\Entity
 */
class PostinfoGeography
{
    /**
     * @var int
     *
     * @ORM\Column(name="GEO_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $geoId;

    /**
     * @var string
     *
     * @ORM\Column(name="GEO_NAME", type="string", length=255, nullable=false)
     */
    private $geoName;

    /**
     * @var string
     *
     * @ORM\Column(name="GEO_NAME_ENG", type="string", length=255, nullable=false)
     */
    private $geoNameEng;

    public function getGeoId(): ?int
    {
        return $this->geoId;
    }

    public function getGeoName(): ?string
    {
        return $this->geoName;
    }

    public function setGeoName(string $geoName): self
    {
        $this->geoName = $geoName;

        return $this;
    }

    public function getGeoNameEng(): ?string
    {
        return $this->geoNameEng;
    }

    public function setGeoNameEng(string $geoNameEng): self
    {
        $this->geoNameEng = $geoNameEng;

        return $this;
    }


}
