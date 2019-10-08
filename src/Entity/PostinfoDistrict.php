<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostinfoDistrict
 *
 * @ORM\Table(name="postinfo_district", indexes={@ORM\Index(name="idx_amphr", columns={"AMPHUR_ID"}), @ORM\Index(name="idx_prov", columns={"PROVINCE_ID"}), @ORM\Index(name="idx_distrid_amphr", columns={"DISTRICT_ID", "AMPHUR_ID"}), @ORM\Index(name="idx_distrid_prov", columns={"DISTRICT_ID", "PROVINCE_ID"}), @ORM\Index(name="idx_distr_amphr", columns={"DISTRICT_CODE", "AMPHUR_ID"}), @ORM\Index(name="idx_distr_prov", columns={"DISTRICT_CODE", "PROVINCE_ID"}), @ORM\Index(name="idx_distr_geo", columns={"DISTRICT_CODE", "GEO_ID"})})
 * @ORM\Entity
 */
class PostinfoDistrict
{
    /**
     * @var int
     *
     * @ORM\Column(name="DISTRICT_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $districtId;

    /**
     * @var string
     *
     * @ORM\Column(name="DISTRICT_CODE", type="string", length=6, nullable=false)
     */
    private $districtCode;

    /**
     * @var string
     *
     * @ORM\Column(name="DISTRICT_NAME", type="string", length=150, nullable=false)
     */
    private $districtName;

    /**
     * @var string
     *
     * @ORM\Column(name="DISTRICT_NAME_ENG", type="string", length=150, nullable=false)
     */
    private $districtNameEng;

    /**
     * @var int
     *
     * @ORM\Column(name="AMPHUR_ID", type="integer", nullable=false)
     */
    private $amphurId = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="PROVINCE_ID", type="integer", nullable=false)
     */
    private $provinceId = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="GEO_ID", type="integer", nullable=false)
     */
    private $geoId = '0';

    public function getDistrictId(): ?int
    {
        return $this->districtId;
    }

    public function getDistrictCode(): ?string
    {
        return $this->districtCode;
    }

    public function setDistrictCode(string $districtCode): self
    {
        $this->districtCode = $districtCode;

        return $this;
    }

    public function getDistrictName(): ?string
    {
        return $this->districtName;
    }

    public function setDistrictName(string $districtName): self
    {
        $this->districtName = $districtName;

        return $this;
    }

    public function getDistrictNameEng(): ?string
    {
        return $this->districtNameEng;
    }

    public function setDistrictNameEng(string $districtNameEng): self
    {
        $this->districtNameEng = $districtNameEng;

        return $this;
    }

    public function getAmphurId(): ?int
    {
        return $this->amphurId;
    }

    public function setAmphurId(int $amphurId): self
    {
        $this->amphurId = $amphurId;

        return $this;
    }

    public function getProvinceId(): ?int
    {
        return $this->provinceId;
    }

    public function setProvinceId(int $provinceId): self
    {
        $this->provinceId = $provinceId;

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
