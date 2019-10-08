<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MerchantBillingWarehouseToParcel
 *
 * @ORM\Table(name="merchant_billing_warehouse_to_parcel", indexes={@ORM\Index(name="takeorderby_payment_invoice_idx", columns={"takeorderby", "payment_invoice"}), @ORM\Index(name="global_productid", columns={"global_productid"}), @ORM\Index(name="takeorderby_idx", columns={"takeorderby"}), @ORM\Index(name="global_productid_idx", columns={"global_productid"})})
 * @ORM\Entity
 */
class MerchantBillingWarehouseToParcel
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
     * @var string|null
     *
     * @ORM\Column(name="mer_type", type="string", length=10, nullable=true)
     */
    private $merType;

    /**
     * @var int
     *
     * @ORM\Column(name="merchant_to_parcel", type="integer", nullable=false)
     */
    private $merchantToParcel;

    /**
     * @var int|null
     *
     * @ORM\Column(name="takeorderby", type="integer", nullable=true)
     */
    private $takeorderby;

    /**
     * @var string|null
     *
     * @ORM\Column(name="payment_invoice", type="string", length=16, nullable=true)
     */
    private $paymentInvoice;

    /**
     * @var int|null
     *
     * @ORM\Column(name="productid", type="integer", nullable=true)
     */
    private $productid;

    /**
     * @var int
     *
     * @ORM\Column(name="global_productid", type="integer", nullable=false)
     */
    private $globalProductid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productname", type="string", length=300, nullable=true)
     */
    private $productname;

    /**
     * @var int|null
     *
     * @ORM\Column(name="productorder", type="integer", nullable=true)
     */
    private $productorder;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productprice", type="decimal", precision=10, scale=4, nullable=true)
     */
    private $productprice;

    /**
     * @var string
     *
     * @ORM\Column(name="productcost", type="decimal", precision=10, scale=4, nullable=false)
     */
    private $productcost;

    /**
     * @var string|null
     *
     * @ORM\Column(name="delivery_fee_multi_step", type="string", length=1500, nullable=true)
     */
    private $deliveryFeeMultiStep;

    /**
     * @var string|null
     *
     * @ORM\Column(name="delivery_fee", type="decimal", precision=10, scale=4, nullable=true)
     */
    private $deliveryFee;

    /**
     * @var bool
     *
     * @ORM\Column(name="delivery_fee_in_price", type="boolean", nullable=false, options={"default"="1"})
     */
    private $deliveryFeeInPrice = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="delivery_fee_ratio", type="integer", nullable=false)
     */
    private $deliveryFeeRatio = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="imgproductonbill", type="string", length=300, nullable=true)
     */
    private $imgproductonbill;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imgproductpathonbill", type="string", length=300, nullable=true)
     */
    private $imgproductpathonbill;

    /**
     * @var string|null
     *
     * @ORM\Column(name="noteremark", type="string", length=1000, nullable=true)
     */
    private $noteremark;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commissionset", type="string", length=1000, nullable=true)
     */
    private $commissionset;

    /**
     * @var string|null
     *
     * @ORM\Column(name="parcel_ref", type="string", length=20, nullable=true)
     */
    private $parcelRef;

    /**
     * @var string|null
     *
     * @ORM\Column(name="parcel_bill_no", type="string", length=50, nullable=true)
     */
    private $parcelBillNo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="parcel_member_id", type="string", length=20, nullable=true)
     */
    private $parcelMemberId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ext_record_id", type="string", length=100, nullable=true)
     */
    private $extRecordId;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="timestamp", type="datetime", nullable=true)
     */
    private $timestamp;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getMerType(): ?string
    {
        return $this->merType;
    }

    public function setMerType(?string $merType): self
    {
        $this->merType = $merType;

        return $this;
    }

    public function getMerchantToParcel(): ?int
    {
        return $this->merchantToParcel;
    }

    public function setMerchantToParcel(int $merchantToParcel): self
    {
        $this->merchantToParcel = $merchantToParcel;

        return $this;
    }

    public function getTakeorderby(): ?int
    {
        return $this->takeorderby;
    }

    public function setTakeorderby(?int $takeorderby): self
    {
        $this->takeorderby = $takeorderby;

        return $this;
    }

    public function getPaymentInvoice(): ?string
    {
        return $this->paymentInvoice;
    }

    public function setPaymentInvoice(?string $paymentInvoice): self
    {
        $this->paymentInvoice = $paymentInvoice;

        return $this;
    }

    public function getProductid(): ?int
    {
        return $this->productid;
    }

    public function setProductid(?int $productid): self
    {
        $this->productid = $productid;

        return $this;
    }

    public function getGlobalProductid(): ?int
    {
        return $this->globalProductid;
    }

    public function setGlobalProductid(int $globalProductid): self
    {
        $this->globalProductid = $globalProductid;

        return $this;
    }

    public function getProductname(): ?string
    {
        return $this->productname;
    }

    public function setProductname(?string $productname): self
    {
        $this->productname = $productname;

        return $this;
    }

    public function getProductorder(): ?int
    {
        return $this->productorder;
    }

    public function setProductorder(?int $productorder): self
    {
        $this->productorder = $productorder;

        return $this;
    }

    public function getProductprice(): ?string
    {
        return $this->productprice;
    }

    public function setProductprice(?string $productprice): self
    {
        $this->productprice = $productprice;

        return $this;
    }

    public function getProductcost(): ?string
    {
        return $this->productcost;
    }

    public function setProductcost(string $productcost): self
    {
        $this->productcost = $productcost;

        return $this;
    }

    public function getDeliveryFeeMultiStep(): ?string
    {
        return $this->deliveryFeeMultiStep;
    }

    public function setDeliveryFeeMultiStep(?string $deliveryFeeMultiStep): self
    {
        $this->deliveryFeeMultiStep = $deliveryFeeMultiStep;

        return $this;
    }

    public function getDeliveryFee(): ?string
    {
        return $this->deliveryFee;
    }

    public function setDeliveryFee(?string $deliveryFee): self
    {
        $this->deliveryFee = $deliveryFee;

        return $this;
    }

    public function getDeliveryFeeInPrice(): ?bool
    {
        return $this->deliveryFeeInPrice;
    }

    public function setDeliveryFeeInPrice(bool $deliveryFeeInPrice): self
    {
        $this->deliveryFeeInPrice = $deliveryFeeInPrice;

        return $this;
    }

    public function getDeliveryFeeRatio(): ?int
    {
        return $this->deliveryFeeRatio;
    }

    public function setDeliveryFeeRatio(int $deliveryFeeRatio): self
    {
        $this->deliveryFeeRatio = $deliveryFeeRatio;

        return $this;
    }

    public function getImgproductonbill(): ?string
    {
        return $this->imgproductonbill;
    }

    public function setImgproductonbill(?string $imgproductonbill): self
    {
        $this->imgproductonbill = $imgproductonbill;

        return $this;
    }

    public function getImgproductpathonbill(): ?string
    {
        return $this->imgproductpathonbill;
    }

    public function setImgproductpathonbill(?string $imgproductpathonbill): self
    {
        $this->imgproductpathonbill = $imgproductpathonbill;

        return $this;
    }

    public function getNoteremark(): ?string
    {
        return $this->noteremark;
    }

    public function setNoteremark(?string $noteremark): self
    {
        $this->noteremark = $noteremark;

        return $this;
    }

    public function getCommissionset(): ?string
    {
        return $this->commissionset;
    }

    public function setCommissionset(?string $commissionset): self
    {
        $this->commissionset = $commissionset;

        return $this;
    }

    public function getParcelRef(): ?string
    {
        return $this->parcelRef;
    }

    public function setParcelRef(?string $parcelRef): self
    {
        $this->parcelRef = $parcelRef;

        return $this;
    }

    public function getParcelBillNo(): ?string
    {
        return $this->parcelBillNo;
    }

    public function setParcelBillNo(?string $parcelBillNo): self
    {
        $this->parcelBillNo = $parcelBillNo;

        return $this;
    }

    public function getParcelMemberId(): ?string
    {
        return $this->parcelMemberId;
    }

    public function setParcelMemberId(?string $parcelMemberId): self
    {
        $this->parcelMemberId = $parcelMemberId;

        return $this;
    }

    public function getExtRecordId(): ?string
    {
        return $this->extRecordId;
    }

    public function setExtRecordId(?string $extRecordId): self
    {
        $this->extRecordId = $extRecordId;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(?\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }


}
