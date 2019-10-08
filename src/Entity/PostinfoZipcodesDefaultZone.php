<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostinfoZipcodesDefaultZone
 *
 * @ORM\Table(name="postinfo_zipcodes_default_zone", indexes={@ORM\Index(name="idx_zip_distr", columns={"zipcode", "district_code"}), @ORM\Index(name="idx_distr_zip", columns={"district_code", "zipcode"}), @ORM\Index(name="idx_distr", columns={"district_code"})})
 * @ORM\Entity
 */
class PostinfoZipcodesDefaultZone
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="district_code", type="string", length=6, nullable=false)
     */
    private $districtCode;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=5, nullable=false)
     */
    private $zipcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="zone_priority", type="string", length=1000, nullable=true)
     */
    private $zonePriority;

    /**
     * @var bool
     *
     * @ORM\Column(name="thaipost", type="boolean", nullable=false)
     */
    private $thaipost = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="alphacansend", type="boolean", nullable=false)
     */
    private $alphacansend = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="kerryexpress", type="boolean", nullable=false)
     */
    private $kerryexpress = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="kerryremotearea", type="boolean", nullable=false)
     */
    private $kerryremotearea = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="nimexpress", type="boolean", nullable=false)
     */
    private $nimexpress = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="blueandwhite", type="boolean", nullable=false)
     */
    private $blueandwhite = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="extra945holding", type="boolean", nullable=false)
     */
    private $extra945holding = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="nikologistics", type="boolean", nullable=false)
     */
    private $nikologistics = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="exp945holding", type="boolean", nullable=false)
     */
    private $exp945holding = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="dhlexpress", type="boolean", nullable=false)
     */
    private $dhlexpress = '0';

    public function getId(): ?int
    {
        return $this->id;
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

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getZonePriority(): ?string
    {
        return $this->zonePriority;
    }

    public function setZonePriority(?string $zonePriority): self
    {
        $this->zonePriority = $zonePriority;

        return $this;
    }

    public function getThaipost(): ?bool
    {
        return $this->thaipost;
    }

    public function setThaipost(bool $thaipost): self
    {
        $this->thaipost = $thaipost;

        return $this;
    }

    public function getAlphacansend(): ?bool
    {
        return $this->alphacansend;
    }

    public function setAlphacansend(bool $alphacansend): self
    {
        $this->alphacansend = $alphacansend;

        return $this;
    }

    public function getKerryexpress(): ?bool
    {
        return $this->kerryexpress;
    }

    public function setKerryexpress(bool $kerryexpress): self
    {
        $this->kerryexpress = $kerryexpress;

        return $this;
    }

    public function getKerryremotearea(): ?bool
    {
        return $this->kerryremotearea;
    }

    public function setKerryremotearea(bool $kerryremotearea): self
    {
        $this->kerryremotearea = $kerryremotearea;

        return $this;
    }

    public function getNimexpress(): ?bool
    {
        return $this->nimexpress;
    }

    public function setNimexpress(bool $nimexpress): self
    {
        $this->nimexpress = $nimexpress;

        return $this;
    }

    public function getBlueandwhite(): ?bool
    {
        return $this->blueandwhite;
    }

    public function setBlueandwhite(bool $blueandwhite): self
    {
        $this->blueandwhite = $blueandwhite;

        return $this;
    }

    public function getExtra945holding(): ?bool
    {
        return $this->extra945holding;
    }

    public function setExtra945holding(bool $extra945holding): self
    {
        $this->extra945holding = $extra945holding;

        return $this;
    }

    public function getNikologistics(): ?bool
    {
        return $this->nikologistics;
    }

    public function setNikologistics(bool $nikologistics): self
    {
        $this->nikologistics = $nikologistics;

        return $this;
    }

    public function getExp945holding(): ?bool
    {
        return $this->exp945holding;
    }

    public function setExp945holding(bool $exp945holding): self
    {
        $this->exp945holding = $exp945holding;

        return $this;
    }

    public function getDhlexpress(): ?bool
    {
        return $this->dhlexpress;
    }

    public function setDhlexpress(bool $dhlexpress): self
    {
        $this->dhlexpress = $dhlexpress;

        return $this;
    }


}
