<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MerchantCustomerRegis
 *
 * @ORM\Table(name="merchant_customer_regis", indexes={@ORM\Index(name="idx_regisphoneno", columns={"regisphoneno"})})
 * @ORM\Entity
 */
class MerchantCustomerRegis
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="takeorderby", type="integer", nullable=false)
     */
    private $takeorderby;

    /**
     * @var string
     *
     * @ORM\Column(name="regisname", type="string", length=200, nullable=false)
     */
    private $regisname;

    /**
     * @var string
     *
     * @ORM\Column(name="regisaddr", type="string", length=1000, nullable=false)
     */
    private $regisaddr;

    /**
     * @var string
     *
     * @ORM\Column(name="district", type="string", length=150, nullable=false)
     */
    private $district;

    /**
     * @var string
     *
     * @ORM\Column(name="districtcode", type="string", length=150, nullable=false)
     */
    private $districtcode;

    /**
     * @var string
     *
     * @ORM\Column(name="amphur", type="string", length=150, nullable=false)
     */
    private $amphur;

    /**
     * @var string
     *
     * @ORM\Column(name="amphercode", type="string", length=150, nullable=false)
     */
    private $amphercode;

    /**
     * @var string
     *
     * @ORM\Column(name="province", type="string", length=150, nullable=false)
     */
    private $province;

    /**
     * @var string
     *
     * @ORM\Column(name="provincecode", type="string", length=150, nullable=false)
     */
    private $provincecode;

    /**
     * @var string
     *
     * @ORM\Column(name="geoname", type="string", length=150, nullable=false)
     */
    private $geoname;

    /**
     * @var string
     *
     * @ORM\Column(name="geoid", type="string", length=2, nullable=false)
     */
    private $geoid;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=5, nullable=false)
     */
    private $zipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="regisphoneno", type="string", length=20, nullable=false)
     */
    private $regisphoneno;

    /**
     * @var string
     *
     * @ORM\Column(name="otppassword", type="string", length=200, nullable=false)
     */
    private $otppassword;

    /**
     * @var string
     *
     * @ORM\Column(name="regisemail", type="string", length=255, nullable=false)
     */
    private $regisemail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="regisdate", type="datetime", nullable=false)
     */
    private $regisdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastupdate", type="datetime", nullable=false)
     */
    private $lastupdate;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=0, nullable=false, options={"default"="active"})
     */
    private $status = 'active';

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTakeorderby(): ?int
    {
        return $this->takeorderby;
    }

    public function setTakeorderby(int $takeorderby): self
    {
        $this->takeorderby = $takeorderby;

        return $this;
    }

    public function getRegisname(): ?string
    {
        return $this->regisname;
    }

    public function setRegisname(string $regisname): self
    {
        $this->regisname = $regisname;

        return $this;
    }

    public function getRegisaddr(): ?string
    {
        return $this->regisaddr;
    }

    public function setRegisaddr(string $regisaddr): self
    {
        $this->regisaddr = $regisaddr;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(string $district): self
    {
        $this->district = $district;

        return $this;
    }

    public function getDistrictcode(): ?string
    {
        return $this->districtcode;
    }

    public function setDistrictcode(string $districtcode): self
    {
        $this->districtcode = $districtcode;

        return $this;
    }

    public function getAmphur(): ?string
    {
        return $this->amphur;
    }

    public function setAmphur(string $amphur): self
    {
        $this->amphur = $amphur;

        return $this;
    }

    public function getAmphercode(): ?string
    {
        return $this->amphercode;
    }

    public function setAmphercode(string $amphercode): self
    {
        $this->amphercode = $amphercode;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(string $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getProvincecode(): ?string
    {
        return $this->provincecode;
    }

    public function setProvincecode(string $provincecode): self
    {
        $this->provincecode = $provincecode;

        return $this;
    }

    public function getGeoname(): ?string
    {
        return $this->geoname;
    }

    public function setGeoname(string $geoname): self
    {
        $this->geoname = $geoname;

        return $this;
    }

    public function getGeoid(): ?string
    {
        return $this->geoid;
    }

    public function setGeoid(string $geoid): self
    {
        $this->geoid = $geoid;

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

    public function getRegisphoneno(): ?string
    {
        return $this->regisphoneno;
    }

    public function setRegisphoneno(string $regisphoneno): self
    {
        $this->regisphoneno = $regisphoneno;

        return $this;
    }

    public function getOtppassword(): ?string
    {
        return $this->otppassword;
    }

    public function setOtppassword(string $otppassword): self
    {
        $this->otppassword = $otppassword;

        return $this;
    }

    public function getRegisemail(): ?string
    {
        return $this->regisemail;
    }

    public function setRegisemail(string $regisemail): self
    {
        $this->regisemail = $regisemail;

        return $this;
    }

    public function getRegisdate(): ?\DateTimeInterface
    {
        return $this->regisdate;
    }

    public function setRegisdate(\DateTimeInterface $regisdate): self
    {
        $this->regisdate = $regisdate;

        return $this;
    }

    public function getLastupdate(): ?\DateTimeInterface
    {
        return $this->lastupdate;
    }

    public function setLastupdate(\DateTimeInterface $lastupdate): self
    {
        $this->lastupdate = $lastupdate;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }


}
