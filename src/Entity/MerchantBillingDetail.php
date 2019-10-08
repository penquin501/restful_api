<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MerchantBillingDetail
 *
 * @ORM\Table(name="merchant_billing_detail", indexes={@ORM\Index(name="takeorderby_payment_invoice_idx", columns={"takeorderby", "payment_invoice"}), @ORM\Index(name="global_productid_idx", columns={"global_productid"}), @ORM\Index(name="takeorderby_idx", columns={"takeorderby"})})
 * @ORM\Entity
 */
class MerchantBillingDetail
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
     * @var int
     *
     * @ORM\Column(name="product_point", type="integer", nullable=false)
     */
    private $productPoint = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="product_commission", type="decimal", precision=10, scale=4, nullable=false, options={"default"="0.0000"})
     */
    private $productCommission = '0.0000';

    /**
     * @var bool
     *
     * @ORM\Column(name="product_commission_percent", type="boolean", nullable=false)
     */
    private $productCommissionPercent = '0';

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
     * @var \DateTime|null
     *
     * @ORM\Column(name="timestamp", type="datetime", nullable=true)
     */
    private $timestamp;

    /**
     * @var int
     *
     * @ORM\Column(name="ownerproduct", type="integer", nullable=false)
     */
    private $ownerproduct;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_bill_no", type="string", length=12, nullable=false)
     */
    private $ownerBillNo;

    public function getId(): ?string
    {
        return $this->id;
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

    public function getProductPoint(): ?int
    {
        return $this->productPoint;
    }

    public function setProductPoint(int $productPoint): self
    {
        $this->productPoint = $productPoint;

        return $this;
    }

    public function getProductCommission(): ?string
    {
        return $this->productCommission;
    }

    public function setProductCommission(string $productCommission): self
    {
        $this->productCommission = $productCommission;

        return $this;
    }

    public function getProductCommissionPercent(): ?bool
    {
        return $this->productCommissionPercent;
    }

    public function setProductCommissionPercent(bool $productCommissionPercent): self
    {
        $this->productCommissionPercent = $productCommissionPercent;

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

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(?\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getOwnerproduct(): ?int
    {
        return $this->ownerproduct;
    }

    public function setOwnerproduct(int $ownerproduct): self
    {
        $this->ownerproduct = $ownerproduct;

        return $this;
    }

    public function getOwnerBillNo(): ?string
    {
        return $this->ownerBillNo;
    }

    public function setOwnerBillNo(string $ownerBillNo): self
    {
        $this->ownerBillNo = $ownerBillNo;

        return $this;
    }


}
