<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogImgParcelAgent
 *
 * @ORM\Table(name="log_img_parcel_agent")
 * @ORM\Entity
 */
class LogImgParcelAgent
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
     * @var string|null
     *
     * @ORM\Column(name="member_id", type="string", length=50, nullable=true)
     */
    private $memberId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="img_url_citizen", type="string", length=300, nullable=true)
     */
    private $imgUrlCitizen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="img_url_bank", type="string", length=300, nullable=true)
     */
    private $imgUrlBank;

    /**
     * @var string|null
     *
     * @ORM\Column(name="raw_data_register", type="string", length=5000, nullable=true)
     */
    private $rawDataRegister;

    /**
     * @var string|null
     *
     * @ORM\Column(name="raw_data_bank", type="string", length=5000, nullable=true)
     */
    private $rawDataBank;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="record_date_register", type="datetime", nullable=true)
     */
    private $recordDateRegister;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="record_date_bank", type="datetime", nullable=true)
     */
    private $recordDateBank;

    /**
     * @var string|null
     *
     * @ORM\Column(name="source", type="string", length=50, nullable=true)
     */
    private $source;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMemberId(): ?string
    {
        return $this->memberId;
    }

    public function setMemberId(?string $memberId): self
    {
        $this->memberId = $memberId;

        return $this;
    }

    public function getImgUrlCitizen(): ?string
    {
        return $this->imgUrlCitizen;
    }

    public function setImgUrlCitizen(?string $imgUrlCitizen): self
    {
        $this->imgUrlCitizen = $imgUrlCitizen;

        return $this;
    }

    public function getImgUrlBank(): ?string
    {
        return $this->imgUrlBank;
    }

    public function setImgUrlBank(?string $imgUrlBank): self
    {
        $this->imgUrlBank = $imgUrlBank;

        return $this;
    }

    public function getRawDataRegister(): ?string
    {
        return $this->rawDataRegister;
    }

    public function setRawDataRegister(?string $rawDataRegister): self
    {
        $this->rawDataRegister = $rawDataRegister;

        return $this;
    }

    public function getRawDataBank(): ?string
    {
        return $this->rawDataBank;
    }

    public function setRawDataBank(?string $rawDataBank): self
    {
        $this->rawDataBank = $rawDataBank;

        return $this;
    }

    public function getRecordDateRegister(): ?\DateTimeInterface
    {
        return $this->recordDateRegister;
    }

    public function setRecordDateRegister(?\DateTimeInterface $recordDateRegister): self
    {
        $this->recordDateRegister = $recordDateRegister;

        return $this;
    }

    public function getRecordDateBank(): ?\DateTimeInterface
    {
        return $this->recordDateBank;
    }

    public function setRecordDateBank(?\DateTimeInterface $recordDateBank): self
    {
        $this->recordDateBank = $recordDateBank;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): self
    {
        $this->source = $source;

        return $this;
    }


}
