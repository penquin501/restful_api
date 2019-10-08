<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParcelTempCapture
 *
 * @ORM\Table(name="parcel_temp_capture", indexes={@ORM\Index(name="raw_data_create_date", columns={"recorddate"}), @ORM\Index(name="consignmentno", columns={"consignmentno"})})
 * @ORM\Entity
 */
class ParcelTempCapture
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=250, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="consignmentno", type="string", length=15, nullable=false)
     */
    private $consignmentno;

    /**
     * @var string
     *
     * @ORM\Column(name="imageurl", type="string", length=300, nullable=false)
     */
    private $imageurl;

    /**
     * @var string
     *
     * @ORM\Column(name="imagepath", type="string", length=50, nullable=false)
     */
    private $imagepath;

    /**
     * @var string
     *
     * @ORM\Column(name="rawdata", type="text", length=16777215, nullable=false)
     */
    private $rawdata;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="recorddate", type="date", nullable=true)
     */
    private $recorddate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="recordtimestamp", type="datetime", nullable=false)
     */
    private $recordtimestamp;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getConsignmentno(): ?string
    {
        return $this->consignmentno;
    }

    public function setConsignmentno(string $consignmentno): self
    {
        $this->consignmentno = $consignmentno;

        return $this;
    }

    public function getImageurl(): ?string
    {
        return $this->imageurl;
    }

    public function setImageurl(string $imageurl): self
    {
        $this->imageurl = $imageurl;

        return $this;
    }

    public function getImagepath(): ?string
    {
        return $this->imagepath;
    }

    public function setImagepath(string $imagepath): self
    {
        $this->imagepath = $imagepath;

        return $this;
    }

    public function getRawdata(): ?string
    {
        return $this->rawdata;
    }

    public function setRawdata(string $rawdata): self
    {
        $this->rawdata = $rawdata;

        return $this;
    }

    public function getRecorddate(): ?\DateTimeInterface
    {
        return $this->recorddate;
    }

    public function setRecorddate(?\DateTimeInterface $recorddate): self
    {
        $this->recorddate = $recorddate;

        return $this;
    }

    public function getRecordtimestamp(): ?\DateTimeInterface
    {
        return $this->recordtimestamp;
    }

    public function setRecordtimestamp(\DateTimeInterface $recordtimestamp): self
    {
        $this->recordtimestamp = $recordtimestamp;

        return $this;
    }


}
