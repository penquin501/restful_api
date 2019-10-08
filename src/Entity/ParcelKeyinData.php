<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParcelKeyinData
 *
 * @ORM\Table(name="parcel_keyin_data", indexes={@ORM\Index(name="idx_operator", columns={"operator"}), @ORM\Index(name="consignmentno", columns={"consignmentno"}), @ORM\Index(name="idx_recorddate", columns={"recorddate"})})
 * @ORM\Entity
 */
class ParcelKeyinData
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
     * @ORM\Column(name="operator", type="string", length=15, nullable=false)
     */
    private $operator;

    /**
     * @var string
     *
     * @ORM\Column(name="consignmentno", type="string", length=15, nullable=false)
     */
    private $consignmentno;

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

    public function getOperator(): ?string
    {
        return $this->operator;
    }

    public function setOperator(string $operator): self
    {
        $this->operator = $operator;

        return $this;
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
