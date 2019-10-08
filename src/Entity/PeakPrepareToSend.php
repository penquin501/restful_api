<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PeakPrepareToSend
 *
 * @ORM\Table(name="peak_prepare_to_send")
 * @ORM\Entity
 */
class PeakPrepareToSend
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
     * @ORM\Column(name="record_type", type="string", length=0, nullable=false)
     */
    private $recordType;

    /**
     * @var string
     *
     * @ORM\Column(name="bill_no", type="string", length=60, nullable=false)
     */
    private $billNo;

    /**
     * @var int
     *
     * @ORM\Column(name="mer", type="integer", nullable=false)
     */
    private $mer;

    /**
     * @var string
     *
     * @ORM\Column(name="invoice", type="string", length=16, nullable=false)
     */
    private $invoice;

    /**
     * @var string
     *
     * @ORM\Column(name="peak_method", type="string", length=25, nullable=false)
     */
    private $peakMethod;

    /**
     * @var string
     *
     * @ORM\Column(name="peak_code", type="string", length=150, nullable=false)
     */
    private $peakCode;

    /**
     * @var int
     *
     * @ORM\Column(name="peak_order_number", type="integer", nullable=false)
     */
    private $peakOrderNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="json_send", type="text", length=0, nullable=false)
     */
    private $jsonSend;

    /**
     * @var string
     *
     * @ORM\Column(name="json_result", type="text", length=0, nullable=false)
     */
    private $jsonResult;

    /**
     * @var string
     *
     * @ORM\Column(name="peak_status", type="string", length=20, nullable=false)
     */
    private $peakStatus;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="item_date", type="datetime", nullable=true)
     */
    private $itemDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="recorddate", type="datetime", nullable=true)
     */
    private $recorddate;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getRecordType(): ?string
    {
        return $this->recordType;
    }

    public function setRecordType(string $recordType): self
    {
        $this->recordType = $recordType;

        return $this;
    }

    public function getBillNo(): ?string
    {
        return $this->billNo;
    }

    public function setBillNo(string $billNo): self
    {
        $this->billNo = $billNo;

        return $this;
    }

    public function getMer(): ?int
    {
        return $this->mer;
    }

    public function setMer(int $mer): self
    {
        $this->mer = $mer;

        return $this;
    }

    public function getInvoice(): ?string
    {
        return $this->invoice;
    }

    public function setInvoice(string $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getPeakMethod(): ?string
    {
        return $this->peakMethod;
    }

    public function setPeakMethod(string $peakMethod): self
    {
        $this->peakMethod = $peakMethod;

        return $this;
    }

    public function getPeakCode(): ?string
    {
        return $this->peakCode;
    }

    public function setPeakCode(string $peakCode): self
    {
        $this->peakCode = $peakCode;

        return $this;
    }

    public function getPeakOrderNumber(): ?int
    {
        return $this->peakOrderNumber;
    }

    public function setPeakOrderNumber(int $peakOrderNumber): self
    {
        $this->peakOrderNumber = $peakOrderNumber;

        return $this;
    }

    public function getJsonSend(): ?string
    {
        return $this->jsonSend;
    }

    public function setJsonSend(string $jsonSend): self
    {
        $this->jsonSend = $jsonSend;

        return $this;
    }

    public function getJsonResult(): ?string
    {
        return $this->jsonResult;
    }

    public function setJsonResult(string $jsonResult): self
    {
        $this->jsonResult = $jsonResult;

        return $this;
    }

    public function getPeakStatus(): ?string
    {
        return $this->peakStatus;
    }

    public function setPeakStatus(string $peakStatus): self
    {
        $this->peakStatus = $peakStatus;

        return $this;
    }

    public function getItemDate(): ?\DateTimeInterface
    {
        return $this->itemDate;
    }

    public function setItemDate(?\DateTimeInterface $itemDate): self
    {
        $this->itemDate = $itemDate;

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


}
