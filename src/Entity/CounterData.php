<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CounterData
 *
 * @ORM\Table(name="counter_data", indexes={@ORM\Index(name="scan_date", columns={"scan_date"}), @ORM\Index(name="tracking_no", columns={"tracking_no"})})
 * @ORM\Entity
 */
class CounterData
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
     * @var int
     *
     * @ORM\Column(name="mer_id", type="integer", nullable=false)
     */
    private $merId;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="tracking_no", type="string", length=15, nullable=false)
     */
    private $trackingNo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="transporter", type="string", length=0, nullable=true)
     */
    private $transporter;

    /**
     * @var string
     *
     * @ORM\Column(name="license_plate", type="string", length=15, nullable=false)
     */
    private $licensePlate;

    /**
     * @var string
     *
     * @ORM\Column(name="operator", type="string", length=100, nullable=false)
     */
    private $operator;

    /**
     * @var string
     *
     * @ORM\Column(name="signature", type="string", length=200, nullable=false)
     */
    private $signature;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="scan_date", type="date", nullable=true)
     */
    private $scanDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="scan_time", type="datetime", nullable=true)
     */
    private $scanTime;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="tracking_datestamp", type="date", nullable=true)
     */
    private $trackingDatestamp;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="tracking_timestamp", type="datetime", nullable=true)
     */
    private $trackingTimestamp;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getMerId(): ?int
    {
        return $this->merId;
    }

    public function setMerId(int $merId): self
    {
        $this->merId = $merId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getTrackingNo(): ?string
    {
        return $this->trackingNo;
    }

    public function setTrackingNo(string $trackingNo): self
    {
        $this->trackingNo = $trackingNo;

        return $this;
    }

    public function getTransporter(): ?string
    {
        return $this->transporter;
    }

    public function setTransporter(?string $transporter): self
    {
        $this->transporter = $transporter;

        return $this;
    }

    public function getLicensePlate(): ?string
    {
        return $this->licensePlate;
    }

    public function setLicensePlate(string $licensePlate): self
    {
        $this->licensePlate = $licensePlate;

        return $this;
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

    public function getSignature(): ?string
    {
        return $this->signature;
    }

    public function setSignature(string $signature): self
    {
        $this->signature = $signature;

        return $this;
    }

    public function getScanDate(): ?\DateTimeInterface
    {
        return $this->scanDate;
    }

    public function setScanDate(?\DateTimeInterface $scanDate): self
    {
        $this->scanDate = $scanDate;

        return $this;
    }

    public function getScanTime(): ?\DateTimeInterface
    {
        return $this->scanTime;
    }

    public function setScanTime(?\DateTimeInterface $scanTime): self
    {
        $this->scanTime = $scanTime;

        return $this;
    }

    public function getTrackingDatestamp(): ?\DateTimeInterface
    {
        return $this->trackingDatestamp;
    }

    public function setTrackingDatestamp(?\DateTimeInterface $trackingDatestamp): self
    {
        $this->trackingDatestamp = $trackingDatestamp;

        return $this;
    }

    public function getTrackingTimestamp(): ?\DateTimeInterface
    {
        return $this->trackingTimestamp;
    }

    public function setTrackingTimestamp(?\DateTimeInterface $trackingTimestamp): self
    {
        $this->trackingTimestamp = $trackingTimestamp;

        return $this;
    }


}
