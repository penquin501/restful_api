<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostinfoProvince
 *
 * @ORM\Table(name="postinfo_province", indexes={@ORM\Index(name="idx_provid_provcode_geoid", columns={"PROVINCE_ID", "PROVINCE_CODE", "GEO_ID"})})
 * @ORM\Entity
 */
class PostinfoProvince
{
    /**
     * @var int
     *
     * @ORM\Column(name="PROVINCE_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $provinceId;

    /**
     * @var string
     *
     * @ORM\Column(name="PROVINCE_CODE", type="string", length=2, nullable=false)
     */
    private $provinceCode;

    /**
     * @var string
     *
     * @ORM\Column(name="PROVINCE_NAME", type="string", length=150, nullable=false)
     */
    private $provinceName;

    /**
     * @var string
     *
     * @ORM\Column(name="PROVINCE_NAME_ENG", type="string", length=150, nullable=false)
     */
    private $provinceNameEng;

    /**
     * @var int
     *
     * @ORM\Column(name="GEO_ID", type="integer", nullable=false)
     */
    private $geoId = '0';

    public function getProvinceId(): ?int
    {
        return $this->provinceId;
    }

    public function getProvinceCode(): ?string
    {
        return $this->provinceCode;
    }

    public function setProvinceCode(string $provinceCode): self
    {
        $this->provinceCode = $provinceCode;

        return $this;
    }

    public function getProvinceName(): ?string
    {
        return $this->provinceName;
    }

    public function setProvinceName(string $provinceName): self
    {
        $this->provinceName = $provinceName;

        return $this;
    }

    public function getProvinceNameEng(): ?string
    {
        return $this->provinceNameEng;
    }

    public function setProvinceNameEng(string $provinceNameEng): self
    {
        $this->provinceNameEng = $provinceNameEng;

        return $this;
    }

    public function getGeoId(): ?int
    {
        return $this->geoId;
    }

    public function setGeoId(int $geoId): self
    {
        $this->geoId = $geoId;

        return $this;
    }


}
