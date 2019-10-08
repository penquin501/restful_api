<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostinfoAmphur
 *
 * @ORM\Table(name="postinfo_amphur", indexes={@ORM\Index(name="idx_amphrid_amphrcode_provid_geoid", columns={"AMPHUR_ID", "AMPHUR_CODE", "PROVINCE_ID", "GEO_ID"})})
 * @ORM\Entity
 */
class PostinfoAmphur
{
    /**
     * @var int
     *
     * @ORM\Column(name="AMPHUR_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $amphurId;

    /**
     * @var string
     *
     * @ORM\Column(name="AMPHUR_CODE", type="string", length=4, nullable=false)
     */
    private $amphurCode;

    /**
     * @var string
     *
     * @ORM\Column(name="AMPHUR_NAME", type="string", length=150, nullable=false)
     */
    private $amphurName;

    /**
     * @var string
     *
     * @ORM\Column(name="AMPHUR_NAME_ENG", type="string", length=150, nullable=false)
     */
    private $amphurNameEng;

    /**
     * @var int
     *
     * @ORM\Column(name="GEO_ID", type="integer", nullable=false)
     */
    private $geoId = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="PROVINCE_ID", type="integer", nullable=false)
     */
    private $provinceId = '0';

    public function getAmphurId(): ?int
    {
        return $this->amphurId;
    }

    public function getAmphurCode(): ?string
    {
        return $this->amphurCode;
    }

    public function setAmphurCode(string $amphurCode): self
    {
        $this->amphurCode = $amphurCode;

        return $this;
    }

    public function getAmphurName(): ?string
    {
        return $this->amphurName;
    }

    public function setAmphurName(string $amphurName): self
    {
        $this->amphurName = $amphurName;

        return $this;
    }

    public function getAmphurNameEng(): ?string
    {
        return $this->amphurNameEng;
    }

    public function setAmphurNameEng(string $amphurNameEng): self
    {
        $this->amphurNameEng = $amphurNameEng;

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

    public function getProvinceId(): ?int
    {
        return $this->provinceId;
    }

    public function setProvinceId(int $provinceId): self
    {
        $this->provinceId = $provinceId;

        return $this;
    }


}
