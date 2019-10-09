<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MerchantConfig
 *
 * @ORM\Table(name="merchant_config", indexes={@ORM\Index(name="mer_type", columns={"mer_type"}), @ORM\Index(name="mer_ref", columns={"mer_ref"}), @ORM\Index(name="mer_level", columns={"mer_level"}), @ORM\Index(name="takeorderby", columns={"takeorderby"})})
 * @ORM\Entity
 */
class MerchantConfig
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
     * @var string
     *
     * @ORM\Column(name="mer_type", type="string", length=0, nullable=false, options={"default"="holding"})
     */
    private $merType = 'holding';

    /**
     * @var string|null
     *
     * @ORM\Column(name="mer_level", type="string", length=0, nullable=true)
     */
    private $merLevel;

    /**
     * @var int
     *
     * @ORM\Column(name="mer_ref", type="integer", nullable=false)
     */
    private $merRef;

    /**
     * @var int
     *
     * @ORM\Column(name="takeorderby", type="integer", nullable=false)
     */
    private $takeorderby;

    /**
     * @var string
     *
     * @ORM\Column(name="merchantname", type="string", length=150, nullable=false)
     */
    private $merchantname;

    /**
     * @var string
     *
     * @ORM\Column(name="peak_value", type="string", length=100, nullable=false)
     */
    private $peakValue;

    /**
     * @var string
     *
     * @ORM\Column(name="gps_addr", type="string", length=30, nullable=false)
     */
    private $gpsAddr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="merchantlogo", type="string", length=255, nullable=true)
     */
    private $merchantlogo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="smsuid", type="string", length=30, nullable=true)
     */
    private $smsuid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="smspwd", type="string", length=30, nullable=true)
     */
    private $smspwd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="smssender", type="string", length=30, nullable=true)
     */
    private $smssender;

    /**
     * @var bool
     *
     * @ORM\Column(name="smspaycode", type="boolean", nullable=false)
     */
    private $smspaycode = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="min_order_price", type="decimal", precision=10, scale=4, nullable=false, options={"default"="100.0000"})
     */
    private $minOrderPrice = '100.0000';

    /**
     * @var string
     *
     * @ORM\Column(name="min_cod_order", type="decimal", precision=10, scale=4, nullable=false, options={"default"="0.0000"})
     */
    private $minCodOrder = '0.0000';

    /**
     * @var string
     *
     * @ORM\Column(name="cod_fee", type="decimal", precision=3, scale=2, nullable=false)
     */
    private $codFee;

    /**
     * @var string
     *
     * @ORM\Column(name="min_cod_fee", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $minCodFee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="servicefee", type="decimal", precision=3, scale=2, nullable=true)
     */
    private $servicefee;

    /**
     * @var string
     *
     * @ORM\Column(name="store_fee", type="decimal", precision=10, scale=4, nullable=false)
     */
    private $storeFee;

    /**
     * @var string
     *
     * @ORM\Column(name="pickup_fee", type="decimal", precision=10, scale=4, nullable=false)
     */
    private $pickupFee;

    /**
     * @var string
     *
     * @ORM\Column(name="packet_price", type="decimal", precision=10, scale=4, nullable=false)
     */
    private $packetPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="packing_fee", type="decimal", precision=10, scale=4, nullable=false)
     */
    private $packingFee;

    /**
     * @var string
     *
     * @ORM\Column(name="delivery_fee", type="decimal", precision=10, scale=4, nullable=false)
     */
    private $deliveryFee;

    /**
     * @var string
     *
     * @ORM\Column(name="member_transfer_fee", type="decimal", precision=10, scale=4, nullable=false, options={"default"="20.0000"})
     */
    private $memberTransferFee = '20.0000';

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
     * @var string
     *
     * @ORM\Column(name="inv_prefix", type="string", length=3, nullable=false)
     */
    private $invPrefix;

    /**
     * @var string
     *
     * @ORM\Column(name="let2pay_mid", type="string", length=4, nullable=false)
     */
    private $let2payMid;

    /**
     * @var string
     *
     * @ORM\Column(name="let2pay_seccode", type="string", length=255, nullable=false)
     */
    private $let2paySeccode;

    /**
     * @var string
     *
     * @ORM\Column(name="let2pay_uname", type="string", length=1000, nullable=false)
     */
    private $let2payUname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="merusername", type="string", length=500, nullable=true)
     */
    private $merusername;

    /**
     * @var string|null
     *
     * @ORM\Column(name="merpassword", type="string", length=500, nullable=true)
     */
    private $merpassword;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mer_addr", type="string", length=500, nullable=true)
     */
    private $merAddr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="paymentmethod", type="string", length=100, nullable=true)
     */
    private $paymentmethod;

    /**
     * @var string|null
     *
     * @ORM\Column(name="transportmethod", type="string", length=100, nullable=true)
     */
    private $transportmethod;

    /**
     * @var string|null
     *
     * @ORM\Column(name="transporter_priority", type="string", length=100, nullable=true, options={"default"="[2,3,4,5,6,1]"})
     */
    private $transporterPriority = '[2,3,4,5,6,1]';

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="country_code_authen", type="string", length=1440, nullable=false, options={"default"="["th"]"})
//     */
//    private $countryCodeAuthen = '["th"]';

    /**
     * @var string
     *
     * @ORM\Column(name="special_devices", type="string", length=255, nullable=false, options={"default"="[]"})
     */
    private $specialDevices = '[]';

    /**
     * @var string
     *
     * @ORM\Column(name="multi_pickup", type="string", length=0, nullable=false, options={"default"="no"})
     */
    private $multiPickup = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="posusing", type="string", length=0, nullable=false, options={"default"="disactive"})
     */
    private $posusing = 'disactive';

    /**
     * @var string
     *
     * @ORM\Column(name="stockusing", type="string", length=0, nullable=false, options={"default"="disactive"})
     */
    private $stockusing = 'disactive';

    /**
     * @var bool
     *
     * @ORM\Column(name="minforstockalert", type="boolean", nullable=false)
     */
    private $minforstockalert = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="syncglobalproduct", type="boolean", nullable=false)
     */
    private $syncglobalproduct = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=0, nullable=false, options={"default"="disactive"})
     */
    private $status = 'disactive';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMerType(): ?string
    {
        return $this->merType;
    }

    public function setMerType(string $merType): self
    {
        $this->merType = $merType;

        return $this;
    }

    public function getMerLevel(): ?string
    {
        return $this->merLevel;
    }

    public function setMerLevel(?string $merLevel): self
    {
        $this->merLevel = $merLevel;

        return $this;
    }

    public function getMerRef(): ?int
    {
        return $this->merRef;
    }

    public function setMerRef(int $merRef): self
    {
        $this->merRef = $merRef;

        return $this;
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

    public function getMerchantname(): ?string
    {
        return $this->merchantname;
    }

    public function setMerchantname(string $merchantname): self
    {
        $this->merchantname = $merchantname;

        return $this;
    }

    public function getPeakValue(): ?string
    {
        return $this->peakValue;
    }

    public function setPeakValue(string $peakValue): self
    {
        $this->peakValue = $peakValue;

        return $this;
    }

    public function getGpsAddr(): ?string
    {
        return $this->gpsAddr;
    }

    public function setGpsAddr(string $gpsAddr): self
    {
        $this->gpsAddr = $gpsAddr;

        return $this;
    }

    public function getMerchantlogo(): ?string
    {
        return $this->merchantlogo;
    }

    public function setMerchantlogo(?string $merchantlogo): self
    {
        $this->merchantlogo = $merchantlogo;

        return $this;
    }

    public function getSmsuid(): ?string
    {
        return $this->smsuid;
    }

    public function setSmsuid(?string $smsuid): self
    {
        $this->smsuid = $smsuid;

        return $this;
    }

    public function getSmspwd(): ?string
    {
        return $this->smspwd;
    }

    public function setSmspwd(?string $smspwd): self
    {
        $this->smspwd = $smspwd;

        return $this;
    }

    public function getSmssender(): ?string
    {
        return $this->smssender;
    }

    public function setSmssender(?string $smssender): self
    {
        $this->smssender = $smssender;

        return $this;
    }

    public function getSmspaycode(): ?bool
    {
        return $this->smspaycode;
    }

    public function setSmspaycode(bool $smspaycode): self
    {
        $this->smspaycode = $smspaycode;

        return $this;
    }

    public function getMinOrderPrice(): ?string
    {
        return $this->minOrderPrice;
    }

    public function setMinOrderPrice(string $minOrderPrice): self
    {
        $this->minOrderPrice = $minOrderPrice;

        return $this;
    }

    public function getMinCodOrder(): ?string
    {
        return $this->minCodOrder;
    }

    public function setMinCodOrder(string $minCodOrder): self
    {
        $this->minCodOrder = $minCodOrder;

        return $this;
    }

    public function getCodFee(): ?string
    {
        return $this->codFee;
    }

    public function setCodFee(string $codFee): self
    {
        $this->codFee = $codFee;

        return $this;
    }

    public function getMinCodFee(): ?string
    {
        return $this->minCodFee;
    }

    public function setMinCodFee(string $minCodFee): self
    {
        $this->minCodFee = $minCodFee;

        return $this;
    }

    public function getServicefee(): ?string
    {
        return $this->servicefee;
    }

    public function setServicefee(?string $servicefee): self
    {
        $this->servicefee = $servicefee;

        return $this;
    }

    public function getStoreFee(): ?string
    {
        return $this->storeFee;
    }

    public function setStoreFee(string $storeFee): self
    {
        $this->storeFee = $storeFee;

        return $this;
    }

    public function getPickupFee(): ?string
    {
        return $this->pickupFee;
    }

    public function setPickupFee(string $pickupFee): self
    {
        $this->pickupFee = $pickupFee;

        return $this;
    }

    public function getPacketPrice(): ?string
    {
        return $this->packetPrice;
    }

    public function setPacketPrice(string $packetPrice): self
    {
        $this->packetPrice = $packetPrice;

        return $this;
    }

    public function getPackingFee(): ?string
    {
        return $this->packingFee;
    }

    public function setPackingFee(string $packingFee): self
    {
        $this->packingFee = $packingFee;

        return $this;
    }

    public function getDeliveryFee(): ?string
    {
        return $this->deliveryFee;
    }

    public function setDeliveryFee(string $deliveryFee): self
    {
        $this->deliveryFee = $deliveryFee;

        return $this;
    }

    public function getMemberTransferFee(): ?string
    {
        return $this->memberTransferFee;
    }

    public function setMemberTransferFee(string $memberTransferFee): self
    {
        $this->memberTransferFee = $memberTransferFee;

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

    public function getInvPrefix(): ?string
    {
        return $this->invPrefix;
    }

    public function setInvPrefix(string $invPrefix): self
    {
        $this->invPrefix = $invPrefix;

        return $this;
    }

    public function getLet2payMid(): ?string
    {
        return $this->let2payMid;
    }

    public function setLet2payMid(string $let2payMid): self
    {
        $this->let2payMid = $let2payMid;

        return $this;
    }

    public function getLet2paySeccode(): ?string
    {
        return $this->let2paySeccode;
    }

    public function setLet2paySeccode(string $let2paySeccode): self
    {
        $this->let2paySeccode = $let2paySeccode;

        return $this;
    }

    public function getLet2payUname(): ?string
    {
        return $this->let2payUname;
    }

    public function setLet2payUname(string $let2payUname): self
    {
        $this->let2payUname = $let2payUname;

        return $this;
    }

    public function getMerusername(): ?string
    {
        return $this->merusername;
    }

    public function setMerusername(?string $merusername): self
    {
        $this->merusername = $merusername;

        return $this;
    }

    public function getMerpassword(): ?string
    {
        return $this->merpassword;
    }

    public function setMerpassword(?string $merpassword): self
    {
        $this->merpassword = $merpassword;

        return $this;
    }

    public function getMerAddr(): ?string
    {
        return $this->merAddr;
    }

    public function setMerAddr(?string $merAddr): self
    {
        $this->merAddr = $merAddr;

        return $this;
    }

    public function getPaymentmethod(): ?string
    {
        return $this->paymentmethod;
    }

    public function setPaymentmethod(?string $paymentmethod): self
    {
        $this->paymentmethod = $paymentmethod;

        return $this;
    }

    public function getTransportmethod(): ?string
    {
        return $this->transportmethod;
    }

    public function setTransportmethod(?string $transportmethod): self
    {
        $this->transportmethod = $transportmethod;

        return $this;
    }

    public function getTransporterPriority(): ?string
    {
        return $this->transporterPriority;
    }

    public function setTransporterPriority(?string $transporterPriority): self
    {
        $this->transporterPriority = $transporterPriority;

        return $this;
    }

    public function getSpecialDevices(): ?string
    {
        return $this->specialDevices;
    }

    public function setSpecialDevices(string $specialDevices): self
    {
        $this->specialDevices = $specialDevices;

        return $this;
    }

    public function getMultiPickup(): ?string
    {
        return $this->multiPickup;
    }

    public function setMultiPickup(string $multiPickup): self
    {
        $this->multiPickup = $multiPickup;

        return $this;
    }

    public function getPosusing(): ?string
    {
        return $this->posusing;
    }

    public function setPosusing(string $posusing): self
    {
        $this->posusing = $posusing;

        return $this;
    }

    public function getStockusing(): ?string
    {
        return $this->stockusing;
    }

    public function setStockusing(string $stockusing): self
    {
        $this->stockusing = $stockusing;

        return $this;
    }

    public function getMinforstockalert(): ?bool
    {
        return $this->minforstockalert;
    }

    public function setMinforstockalert(bool $minforstockalert): self
    {
        $this->minforstockalert = $minforstockalert;

        return $this;
    }

    public function getSyncglobalproduct(): ?bool
    {
        return $this->syncglobalproduct;
    }

    public function setSyncglobalproduct(bool $syncglobalproduct): self
    {
        $this->syncglobalproduct = $syncglobalproduct;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }


}
