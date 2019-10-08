<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MerchantBillingDelivery
 *
 * @ORM\Table(name="merchant_billing_delivery", indexes={@ORM\Index(name="sendmaildate_idx", columns={"sendmaildate"}), @ORM\Index(name="product_parcel_size", columns={"product_parcel_size"}), @ORM\Index(name="mailcode_idx", columns={"mailcode"}), @ORM\Index(name="warehouse_id", columns={"warehouse_id"}), @ORM\Index(name="takeorderby_payment_invoice_idx", columns={"takeorderby", "payment_invoice"}), @ORM\Index(name="payment_invoice_idx", columns={"payment_invoice"}), @ORM\Index(name="takeorderby", columns={"takeorderby"})})
 * @ORM\Entity
 */
class MerchantBillingDelivery
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
     * @var int
     *
     * @ORM\Column(name="takeorderby", type="integer", nullable=false)
     */
    private $takeorderby;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_invoice", type="string", length=16, nullable=false)
     */
    private $paymentInvoice;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_sub_invoice", type="string", length=30, nullable=false)
     */
    private $paymentSubInvoice;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_price", type="decimal", precision=10, scale=4, nullable=false)
     */
    private $codPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="expense_discount", type="decimal", precision=10, scale=4, nullable=false)
     */
    private $expenseDiscount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="global_warehouse", type="string", length=0, nullable=true)
     */
    private $globalWarehouse;

    /**
     * @var int
     *
     * @ORM\Column(name="warehouse_id", type="integer", nullable=false)
     */
    private $warehouseId;

    /**
     * @var string
     *
     * @ORM\Column(name="prepare_mailcode", type="string", length=20, nullable=false, options={"comment"="External Mail Code"})
     */
    private $prepareMailcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mailcode", type="string", length=20, nullable=true)
     */
    private $mailcode;

    /**
     * @var int
     *
     * @ORM\Column(name="transporter_id", type="integer", nullable=false)
     */
    private $transporterId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="remark", type="string", length=3000, nullable=true)
     */
    private $remark;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imgurl", type="string", length=500, nullable=true)
     */
    private $imgurl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="transtatus", type="string", length=0, nullable=true, options={"comment"="'P' Prepare to send from warehouse, 'S' Sent, 'R' Return ,'' No action, 'C' Cancel"})
     */
    private $transtatus;

    /**
     * @var string|null
     *
     * @ORM\Column(name="warehouse_recieved", type="string", length=10, nullable=true)
     */
    private $warehouseRecieved;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="sendmaildate", type="datetime", nullable=true)
     */
    private $sendmaildate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="peak_sendmaildate", type="datetime", nullable=true)
     */
    private $peakSendmaildate;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="send_booking", type="boolean", nullable=true)
     */
    private $sendBooking;

    /**
     * @var int
     *
     * @ORM\Column(name="product_parcel_size", type="integer", nullable=false)
     */
    private $productParcelSize;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="transactiondate", type="datetime", nullable=true)
     */
    private $transactiondate;

    public function getId(): ?int
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

    public function getPaymentInvoice(): ?string
    {
        return $this->paymentInvoice;
    }

    public function setPaymentInvoice(string $paymentInvoice): self
    {
        $this->paymentInvoice = $paymentInvoice;

        return $this;
    }

    public function getPaymentSubInvoice(): ?string
    {
        return $this->paymentSubInvoice;
    }

    public function setPaymentSubInvoice(string $paymentSubInvoice): self
    {
        $this->paymentSubInvoice = $paymentSubInvoice;

        return $this;
    }

    public function getCodPrice(): ?string
    {
        return $this->codPrice;
    }

    public function setCodPrice(string $codPrice): self
    {
        $this->codPrice = $codPrice;

        return $this;
    }

    public function getExpenseDiscount(): ?string
    {
        return $this->expenseDiscount;
    }

    public function setExpenseDiscount(string $expenseDiscount): self
    {
        $this->expenseDiscount = $expenseDiscount;

        return $this;
    }

    public function getGlobalWarehouse(): ?string
    {
        return $this->globalWarehouse;
    }

    public function setGlobalWarehouse(?string $globalWarehouse): self
    {
        $this->globalWarehouse = $globalWarehouse;

        return $this;
    }

    public function getWarehouseId(): ?int
    {
        return $this->warehouseId;
    }

    public function setWarehouseId(int $warehouseId): self
    {
        $this->warehouseId = $warehouseId;

        return $this;
    }

    public function getPrepareMailcode(): ?string
    {
        return $this->prepareMailcode;
    }

    public function setPrepareMailcode(string $prepareMailcode): self
    {
        $this->prepareMailcode = $prepareMailcode;

        return $this;
    }

    public function getMailcode(): ?string
    {
        return $this->mailcode;
    }

    public function setMailcode(?string $mailcode): self
    {
        $this->mailcode = $mailcode;

        return $this;
    }

    public function getTransporterId(): ?int
    {
        return $this->transporterId;
    }

    public function setTransporterId(int $transporterId): self
    {
        $this->transporterId = $transporterId;

        return $this;
    }

    public function getRemark(): ?string
    {
        return $this->remark;
    }

    public function setRemark(?string $remark): self
    {
        $this->remark = $remark;

        return $this;
    }

    public function getImgurl(): ?string
    {
        return $this->imgurl;
    }

    public function setImgurl(?string $imgurl): self
    {
        $this->imgurl = $imgurl;

        return $this;
    }

    public function getTranstatus(): ?string
    {
        return $this->transtatus;
    }

    public function setTranstatus(?string $transtatus): self
    {
        $this->transtatus = $transtatus;

        return $this;
    }

    public function getWarehouseRecieved(): ?string
    {
        return $this->warehouseRecieved;
    }

    public function setWarehouseRecieved(?string $warehouseRecieved): self
    {
        $this->warehouseRecieved = $warehouseRecieved;

        return $this;
    }

    public function getSendmaildate(): ?\DateTimeInterface
    {
        return $this->sendmaildate;
    }

    public function setSendmaildate(?\DateTimeInterface $sendmaildate): self
    {
        $this->sendmaildate = $sendmaildate;

        return $this;
    }

    public function getPeakSendmaildate(): ?\DateTimeInterface
    {
        return $this->peakSendmaildate;
    }

    public function setPeakSendmaildate(?\DateTimeInterface $peakSendmaildate): self
    {
        $this->peakSendmaildate = $peakSendmaildate;

        return $this;
    }

    public function getSendBooking(): ?bool
    {
        return $this->sendBooking;
    }

    public function setSendBooking(?bool $sendBooking): self
    {
        $this->sendBooking = $sendBooking;

        return $this;
    }

    public function getProductParcelSize(): ?int
    {
        return $this->productParcelSize;
    }

    public function setProductParcelSize(int $productParcelSize): self
    {
        $this->productParcelSize = $productParcelSize;

        return $this;
    }

    public function getTransactiondate(): ?\DateTimeInterface
    {
        return $this->transactiondate;
    }

    public function setTransactiondate(?\DateTimeInterface $transactiondate): self
    {
        $this->transactiondate = $transactiondate;

        return $this;
    }


}
