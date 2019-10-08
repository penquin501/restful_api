<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalProduct1
 *
 * @ORM\Table(name="global_product1", indexes={@ORM\Index(name="takeorderby_productid_idx", columns={"productid"}), @ORM\Index(name="productid_idx", columns={"productid"}), @ORM\Index(name="takeorderby_productid_productstatus_idx", columns={"productid", "productstatus"}), @ORM\Index(name="authen_group", columns={"authen_group"})})
 * @ORM\Entity
 */
class GlobalProduct1
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="productid", type="integer", nullable=false)
     */
    private $productid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="product_class", type="string", length=0, nullable=false, options={"default"="merchandise"})
     */
    private $productClass = 'merchandise';

    /**
     * @var int
     *
     * @ORM\Column(name="parcel_size", type="integer", nullable=false)
     */
    private $parcelSize;

    /**
     * @var string|null
     *
     * @ORM\Column(name="refid1", type="string", length=30, nullable=true)
     */
    private $refid1;

    /**
     * @var int|null
     *
     * @ORM\Column(name="createby", type="integer", nullable=true)
     */
    private $createby;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productname", type="string", length=120, nullable=true)
     */
    private $productname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productdetail", type="string", length=1500, nullable=true)
     */
    private $productdetail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productcost", type="decimal", precision=13, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $productcost = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="wholesaleprice", type="decimal", precision=13, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $wholesaleprice = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="productprice", type="decimal", precision=13, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $productprice = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="commission_value", type="decimal", precision=10, scale=4, nullable=false, options={"default"="0.0000"})
     */
    private $commissionValue = '0.0000';

    /**
     * @var bool
     *
     * @ORM\Column(name="commission_percent", type="boolean", nullable=false)
     */
    private $commissionPercent = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="delivery_fee_in_price", type="boolean", nullable=false, options={"default"="1"})
     */
    private $deliveryFeeInPrice = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="delivery_fee_multi_step", type="string", length=1500, nullable=false, options={"default"="[]"})
     */
    private $deliveryFeeMultiStep = '[]';

    /**
     * @var int
     *
     * @ORM\Column(name="delivery_fee_ratio", type="integer", nullable=false)
     */
    private $deliveryFeeRatio = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="delivery_fee", type="decimal", precision=10, scale=4, nullable=true)
     */
    private $deliveryFee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pickup_fee", type="decimal", precision=10, scale=4, nullable=true)
     */
    private $pickupFee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="packet_price", type="decimal", precision=10, scale=4, nullable=true)
     */
    private $packetPrice;

    /**
     * @var string|null
     *
     * @ORM\Column(name="packing_fee", type="decimal", precision=10, scale=4, nullable=true)
     */
    private $packingFee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="store_fee", type="decimal", precision=10, scale=4, nullable=true)
     */
    private $storeFee;

    /**
     * @var string
     *
     * @ORM\Column(name="store_fee_charge_to", type="string", length=0, nullable=false, options={"default"="productowner"})
     */
    private $storeFeeChargeTo = 'productowner';

    /**
     * @var string
     *
     * @ORM\Column(name="pickup_fee_charge_to", type="string", length=0, nullable=false, options={"default"="productowner"})
     */
    private $pickupFeeChargeTo = 'productowner';

    /**
     * @var string
     *
     * @ORM\Column(name="packet_price_charge_to", type="string", length=0, nullable=false, options={"default"="productowner"})
     */
    private $packetPriceChargeTo = 'productowner';

    /**
     * @var string
     *
     * @ORM\Column(name="packing_fee_charge_to", type="string", length=0, nullable=false, options={"default"="productowner"})
     */
    private $packingFeeChargeTo = 'productowner';

    /**
     * @var string
     *
     * @ORM\Column(name="delivery_fee_charge_to", type="string", length=0, nullable=false, options={"default"="salestaff"})
     */
    private $deliveryFeeChargeTo = 'salestaff';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_fee_charge_to", type="string", length=0, nullable=false, options={"default"="salestaff"})
     */
    private $paymentFeeChargeTo = 'salestaff';

    /**
     * @var string|null
     *
     * @ORM\Column(name="global_promotion_raise_id", type="string", length=250, nullable=true)
     */
    private $globalPromotionRaiseId;

    /**
     * @var string
     *
     * @ORM\Column(name="productshare", type="string", length=0, nullable=false, options={"default"="private","comment"="public = all user each merchant , private = each user in merchant"})
     */
    private $productshare = 'private';

    /**
     * @var string|null
     *
     * @ORM\Column(name="producttag", type="string", length=1500, nullable=true)
     */
    private $producttag;

    /**
     * @var string|null
     *
     * @ORM\Column(name="product_categories", type="string", length=255, nullable=true)
     */
    private $productCategories;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productbrand", type="string", length=100, nullable=true)
     */
    private $productbrand;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productmodel", type="string", length=150, nullable=true)
     */
    private $productmodel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productsize", type="string", length=0, nullable=true, options={"default"="2","comment"="1 small 2 normal 3 large 4 extra"})
     */
    private $productsize = '2';

    /**
     * @var int
     *
     * @ORM\Column(name="bkk_parcel_gid", type="integer", nullable=false)
     */
    private $bkkParcelGid;

    /**
     * @var int
     *
     * @ORM\Column(name="upc_parcel_gid", type="integer", nullable=false)
     */
    private $upcParcelGid;

    /**
     * @var string
     *
     * @ORM\Column(name="producttype", type="string", length=0, nullable=false, options={"default"="normal"})
     */
    private $producttype = 'normal';

    /**
     * @var string
     *
     * @ORM\Column(name="authen_group", type="string", length=1500, nullable=false)
     */
    private $authenGroup;

    /**
     * @var string|null
     *
     * @ORM\Column(name="zone_priority", type="string", length=1000, nullable=true)
     */
    private $zonePriority;

    /**
     * @var int
     *
     * @ORM\Column(name="warehouse", type="integer", nullable=false)
     */
    private $warehouse;

    /**
     * @var string
     *
     * @ORM\Column(name="country_code_authen", type="string", length=2, nullable=false, options={"default"="th"})
     */
    private $countryCodeAuthen = 'th';

    /**
     * @var bool
     *
     * @ORM\Column(name="unique_invoice", type="boolean", nullable=false)
     */
    private $uniqueInvoice = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="order_limit", type="integer", nullable=false)
     */
    private $orderLimit = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="products_except", type="string", length=1000, nullable=false, options={"default"="[]"})
     */
    private $productsExcept = '[]';

    /**
     * @var int
     *
     * @ORM\Column(name="limit_delivery_per_day", type="smallint", nullable=false)
     */
    private $limitDeliveryPerDay = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="limit_per_day_group", type="string", length=100, nullable=true)
     */
    private $limitPerDayGroup;

    /**
     * @var string|null
     *
     * @ORM\Column(name="items_group", type="string", length=100, nullable=true)
     */
    private $itemsGroup;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sku_group", type="string", length=100, nullable=true)
     */
    private $skuGroup;

    /**
     * @var string
     *
     * @ORM\Column(name="productstatus", type="string", length=0, nullable=false, options={"default"="active"})
     */
    private $productstatus = 'active';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="productadddate", type="datetime", nullable=true)
     */
    private $productadddate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="productlastupdate", type="datetime", nullable=true)
     */
    private $productlastupdate;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getProductid(): ?int
    {
        return $this->productid;
    }

    public function setProductid(int $productid): self
    {
        $this->productid = $productid;

        return $this;
    }

    public function getProductClass(): ?string
    {
        return $this->productClass;
    }

    public function setProductClass(string $productClass): self
    {
        $this->productClass = $productClass;

        return $this;
    }

    public function getParcelSize(): ?int
    {
        return $this->parcelSize;
    }

    public function setParcelSize(int $parcelSize): self
    {
        $this->parcelSize = $parcelSize;

        return $this;
    }

    public function getRefid1(): ?string
    {
        return $this->refid1;
    }

    public function setRefid1(?string $refid1): self
    {
        $this->refid1 = $refid1;

        return $this;
    }

    public function getCreateby(): ?int
    {
        return $this->createby;
    }

    public function setCreateby(?int $createby): self
    {
        $this->createby = $createby;

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

    public function getProductdetail(): ?string
    {
        return $this->productdetail;
    }

    public function setProductdetail(?string $productdetail): self
    {
        $this->productdetail = $productdetail;

        return $this;
    }

    public function getProductcost(): ?string
    {
        return $this->productcost;
    }

    public function setProductcost(?string $productcost): self
    {
        $this->productcost = $productcost;

        return $this;
    }

    public function getWholesaleprice(): ?string
    {
        return $this->wholesaleprice;
    }

    public function setWholesaleprice(?string $wholesaleprice): self
    {
        $this->wholesaleprice = $wholesaleprice;

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

    public function getCommissionValue(): ?string
    {
        return $this->commissionValue;
    }

    public function setCommissionValue(string $commissionValue): self
    {
        $this->commissionValue = $commissionValue;

        return $this;
    }

    public function getCommissionPercent(): ?bool
    {
        return $this->commissionPercent;
    }

    public function setCommissionPercent(bool $commissionPercent): self
    {
        $this->commissionPercent = $commissionPercent;

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

    public function getDeliveryFeeMultiStep(): ?string
    {
        return $this->deliveryFeeMultiStep;
    }

    public function setDeliveryFeeMultiStep(string $deliveryFeeMultiStep): self
    {
        $this->deliveryFeeMultiStep = $deliveryFeeMultiStep;

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

    public function getDeliveryFee(): ?string
    {
        return $this->deliveryFee;
    }

    public function setDeliveryFee(?string $deliveryFee): self
    {
        $this->deliveryFee = $deliveryFee;

        return $this;
    }

    public function getPickupFee(): ?string
    {
        return $this->pickupFee;
    }

    public function setPickupFee(?string $pickupFee): self
    {
        $this->pickupFee = $pickupFee;

        return $this;
    }

    public function getPacketPrice(): ?string
    {
        return $this->packetPrice;
    }

    public function setPacketPrice(?string $packetPrice): self
    {
        $this->packetPrice = $packetPrice;

        return $this;
    }

    public function getPackingFee(): ?string
    {
        return $this->packingFee;
    }

    public function setPackingFee(?string $packingFee): self
    {
        $this->packingFee = $packingFee;

        return $this;
    }

    public function getStoreFee(): ?string
    {
        return $this->storeFee;
    }

    public function setStoreFee(?string $storeFee): self
    {
        $this->storeFee = $storeFee;

        return $this;
    }

    public function getStoreFeeChargeTo(): ?string
    {
        return $this->storeFeeChargeTo;
    }

    public function setStoreFeeChargeTo(string $storeFeeChargeTo): self
    {
        $this->storeFeeChargeTo = $storeFeeChargeTo;

        return $this;
    }

    public function getPickupFeeChargeTo(): ?string
    {
        return $this->pickupFeeChargeTo;
    }

    public function setPickupFeeChargeTo(string $pickupFeeChargeTo): self
    {
        $this->pickupFeeChargeTo = $pickupFeeChargeTo;

        return $this;
    }

    public function getPacketPriceChargeTo(): ?string
    {
        return $this->packetPriceChargeTo;
    }

    public function setPacketPriceChargeTo(string $packetPriceChargeTo): self
    {
        $this->packetPriceChargeTo = $packetPriceChargeTo;

        return $this;
    }

    public function getPackingFeeChargeTo(): ?string
    {
        return $this->packingFeeChargeTo;
    }

    public function setPackingFeeChargeTo(string $packingFeeChargeTo): self
    {
        $this->packingFeeChargeTo = $packingFeeChargeTo;

        return $this;
    }

    public function getDeliveryFeeChargeTo(): ?string
    {
        return $this->deliveryFeeChargeTo;
    }

    public function setDeliveryFeeChargeTo(string $deliveryFeeChargeTo): self
    {
        $this->deliveryFeeChargeTo = $deliveryFeeChargeTo;

        return $this;
    }

    public function getPaymentFeeChargeTo(): ?string
    {
        return $this->paymentFeeChargeTo;
    }

    public function setPaymentFeeChargeTo(string $paymentFeeChargeTo): self
    {
        $this->paymentFeeChargeTo = $paymentFeeChargeTo;

        return $this;
    }

    public function getGlobalPromotionRaiseId(): ?string
    {
        return $this->globalPromotionRaiseId;
    }

    public function setGlobalPromotionRaiseId(?string $globalPromotionRaiseId): self
    {
        $this->globalPromotionRaiseId = $globalPromotionRaiseId;

        return $this;
    }

    public function getProductshare(): ?string
    {
        return $this->productshare;
    }

    public function setProductshare(string $productshare): self
    {
        $this->productshare = $productshare;

        return $this;
    }

    public function getProducttag(): ?string
    {
        return $this->producttag;
    }

    public function setProducttag(?string $producttag): self
    {
        $this->producttag = $producttag;

        return $this;
    }

    public function getProductCategories(): ?string
    {
        return $this->productCategories;
    }

    public function setProductCategories(?string $productCategories): self
    {
        $this->productCategories = $productCategories;

        return $this;
    }

    public function getProductbrand(): ?string
    {
        return $this->productbrand;
    }

    public function setProductbrand(?string $productbrand): self
    {
        $this->productbrand = $productbrand;

        return $this;
    }

    public function getProductmodel(): ?string
    {
        return $this->productmodel;
    }

    public function setProductmodel(?string $productmodel): self
    {
        $this->productmodel = $productmodel;

        return $this;
    }

    public function getProductsize(): ?string
    {
        return $this->productsize;
    }

    public function setProductsize(?string $productsize): self
    {
        $this->productsize = $productsize;

        return $this;
    }

    public function getBkkParcelGid(): ?int
    {
        return $this->bkkParcelGid;
    }

    public function setBkkParcelGid(int $bkkParcelGid): self
    {
        $this->bkkParcelGid = $bkkParcelGid;

        return $this;
    }

    public function getUpcParcelGid(): ?int
    {
        return $this->upcParcelGid;
    }

    public function setUpcParcelGid(int $upcParcelGid): self
    {
        $this->upcParcelGid = $upcParcelGid;

        return $this;
    }

    public function getProducttype(): ?string
    {
        return $this->producttype;
    }

    public function setProducttype(string $producttype): self
    {
        $this->producttype = $producttype;

        return $this;
    }

    public function getAuthenGroup(): ?string
    {
        return $this->authenGroup;
    }

    public function setAuthenGroup(string $authenGroup): self
    {
        $this->authenGroup = $authenGroup;

        return $this;
    }

    public function getZonePriority(): ?string
    {
        return $this->zonePriority;
    }

    public function setZonePriority(?string $zonePriority): self
    {
        $this->zonePriority = $zonePriority;

        return $this;
    }

    public function getWarehouse(): ?int
    {
        return $this->warehouse;
    }

    public function setWarehouse(int $warehouse): self
    {
        $this->warehouse = $warehouse;

        return $this;
    }

    public function getCountryCodeAuthen(): ?string
    {
        return $this->countryCodeAuthen;
    }

    public function setCountryCodeAuthen(string $countryCodeAuthen): self
    {
        $this->countryCodeAuthen = $countryCodeAuthen;

        return $this;
    }

    public function getUniqueInvoice(): ?bool
    {
        return $this->uniqueInvoice;
    }

    public function setUniqueInvoice(bool $uniqueInvoice): self
    {
        $this->uniqueInvoice = $uniqueInvoice;

        return $this;
    }

    public function getOrderLimit(): ?int
    {
        return $this->orderLimit;
    }

    public function setOrderLimit(int $orderLimit): self
    {
        $this->orderLimit = $orderLimit;

        return $this;
    }

    public function getProductsExcept(): ?string
    {
        return $this->productsExcept;
    }

    public function setProductsExcept(string $productsExcept): self
    {
        $this->productsExcept = $productsExcept;

        return $this;
    }

    public function getLimitDeliveryPerDay(): ?int
    {
        return $this->limitDeliveryPerDay;
    }

    public function setLimitDeliveryPerDay(int $limitDeliveryPerDay): self
    {
        $this->limitDeliveryPerDay = $limitDeliveryPerDay;

        return $this;
    }

    public function getLimitPerDayGroup(): ?string
    {
        return $this->limitPerDayGroup;
    }

    public function setLimitPerDayGroup(?string $limitPerDayGroup): self
    {
        $this->limitPerDayGroup = $limitPerDayGroup;

        return $this;
    }

    public function getItemsGroup(): ?string
    {
        return $this->itemsGroup;
    }

    public function setItemsGroup(?string $itemsGroup): self
    {
        $this->itemsGroup = $itemsGroup;

        return $this;
    }

    public function getSkuGroup(): ?string
    {
        return $this->skuGroup;
    }

    public function setSkuGroup(?string $skuGroup): self
    {
        $this->skuGroup = $skuGroup;

        return $this;
    }

    public function getProductstatus(): ?string
    {
        return $this->productstatus;
    }

    public function setProductstatus(string $productstatus): self
    {
        $this->productstatus = $productstatus;

        return $this;
    }

    public function getProductadddate(): ?\DateTimeInterface
    {
        return $this->productadddate;
    }

    public function setProductadddate(?\DateTimeInterface $productadddate): self
    {
        $this->productadddate = $productadddate;

        return $this;
    }

    public function getProductlastupdate(): ?\DateTimeInterface
    {
        return $this->productlastupdate;
    }

    public function setProductlastupdate(?\DateTimeInterface $productlastupdate): self
    {
        $this->productlastupdate = $productlastupdate;

        return $this;
    }


}
