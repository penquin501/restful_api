<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParcelInputTempData
 *
 * @ORM\Table(name="parcel_input_temp_data", indexes={@ORM\Index(name="consignmentno", columns={"consignmentno"})})
 * @ORM\Entity
 */
class ParcelInputTempData
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
     * @ORM\Column(name="ownner_phone_no", type="string", length=11, nullable=false)
     */
    private $ownnerPhoneNo;

    /**
     * @var string
     *
     * @ORM\Column(name="rawdata", type="text", length=16777215, nullable=false)
     */
    private $rawdata;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="recordtimestamp", type="datetime", nullable=false)
     */
    private $recordtimestamp;

    /**
     * @var bool
     *
     * @ORM\Column(name="send_to_temp_data", type="boolean", nullable=false)
     */
    private $sendToTempData;

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

    public function getOwnnerPhoneNo(): ?string
    {
        return $this->ownnerPhoneNo;
    }

    public function setOwnnerPhoneNo(string $ownnerPhoneNo): self
    {
        $this->ownnerPhoneNo = $ownnerPhoneNo;

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

    public function getRecordtimestamp(): ?\DateTimeInterface
    {
        return $this->recordtimestamp;
    }

    public function setRecordtimestamp(\DateTimeInterface $recordtimestamp): self
    {
        $this->recordtimestamp = $recordtimestamp;

        return $this;
    }

    public function getSendToTempData(): ?bool
    {
        return $this->sendToTempData;
    }

    public function setSendToTempData(bool $sendToTempData): self
    {
        $this->sendToTempData = $sendToTempData;

        return $this;
    }


}
