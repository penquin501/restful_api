<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogDataBestApi
 *
 * @ORM\Table(name="log_data_best_api")
 * @ORM\Entity
 */
class LogDataBestApi
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="record_date", type="datetime", nullable=true)
     */
    private $recordDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tracking_no", type="string", length=100, nullable=true)
     */
    private $trackingNo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="best_waybill", type="string", length=100, nullable=true)
     */
    private $bestWaybill;

    /**
     * @var string|null
     *
     * @ORM\Column(name="raw_data_request", type="string", length=2000, nullable=true)
     */
    private $rawDataRequest;

    /**
     * @var string|null
     *
     * @ORM\Column(name="raw_data_response", type="string", length=2000, nullable=true)
     */
    private $rawDataResponse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="result", type="string", length=500, nullable=true)
     */
    private $result;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecordDate(): ?\DateTimeInterface
    {
        return $this->recordDate;
    }

    public function setRecordDate(?\DateTimeInterface $recordDate): self
    {
        $this->recordDate = $recordDate;

        return $this;
    }

    public function getTrackingNo(): ?string
    {
        return $this->trackingNo;
    }

    public function setTrackingNo(?string $trackingNo): self
    {
        $this->trackingNo = $trackingNo;

        return $this;
    }

    public function getBestWaybill(): ?string
    {
        return $this->bestWaybill;
    }

    public function setBestWaybill(?string $bestWaybill): self
    {
        $this->bestWaybill = $bestWaybill;

        return $this;
    }

    public function getRawDataRequest(): ?string
    {
        return $this->rawDataRequest;
    }

    public function setRawDataRequest(?string $rawDataRequest): self
    {
        $this->rawDataRequest = $rawDataRequest;

        return $this;
    }

    public function getRawDataResponse(): ?string
    {
        return $this->rawDataResponse;
    }

    public function setRawDataResponse(?string $rawDataResponse): self
    {
        $this->rawDataResponse = $rawDataResponse;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(?string $result): self
    {
        $this->result = $result;

        return $this;
    }


}
