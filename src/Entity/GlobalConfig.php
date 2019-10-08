<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalConfig
 *
 * @ORM\Table(name="global_config")
 * @ORM\Entity
 */
class GlobalConfig
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
     * @var string|null
     *
     * @ORM\Column(name="versionstamp", type="string", length=50, nullable=true)
     */
    private $versionstamp;

    /**
     * @var string
     *
     * @ORM\Column(name="counterservice_min_value", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $counterserviceMinValue;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_min_value", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $codMinValue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="min_order_value", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $minOrderValue;

    /**
     * @var string
     *
     * @ORM\Column(name="creditcard_min_value", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $creditcardMinValue;

    /**
     * @var string
     *
     * @ORM\Column(name="banktranster_min_value", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $banktransterMinValue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="servicefee", type="decimal", precision=3, scale=2, nullable=true)
     */
    private $servicefee;

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
     * @var int
     *
     * @ORM\Column(name="member_transfer_fee", type="integer", nullable=false)
     */
    private $memberTransferFee;

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
     * @var bool
     *
     * @ORM\Column(name="minforstockalert", type="boolean", nullable=false)
     */
    private $minforstockalert = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="thaivat", type="decimal", precision=3, scale=2, nullable=true)
     */
    private $thaivat;

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
     * @var string|null
     *
     * @ORM\Column(name="masterkey", type="string", length=20, nullable=true)
     */
    private $masterkey;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVersionstamp(): ?string
    {
        return $this->versionstamp;
    }

    public function setVersionstamp(?string $versionstamp): self
    {
        $this->versionstamp = $versionstamp;

        return $this;
    }

    public function getCounterserviceMinValue(): ?string
    {
        return $this->counterserviceMinValue;
    }

    public function setCounterserviceMinValue(string $counterserviceMinValue): self
    {
        $this->counterserviceMinValue = $counterserviceMinValue;

        return $this;
    }

    public function getCodMinValue(): ?string
    {
        return $this->codMinValue;
    }

    public function setCodMinValue(string $codMinValue): self
    {
        $this->codMinValue = $codMinValue;

        return $this;
    }

    public function getMinOrderValue(): ?string
    {
        return $this->minOrderValue;
    }

    public function setMinOrderValue(?string $minOrderValue): self
    {
        $this->minOrderValue = $minOrderValue;

        return $this;
    }

    public function getCreditcardMinValue(): ?string
    {
        return $this->creditcardMinValue;
    }

    public function setCreditcardMinValue(string $creditcardMinValue): self
    {
        $this->creditcardMinValue = $creditcardMinValue;

        return $this;
    }

    public function getBanktransterMinValue(): ?string
    {
        return $this->banktransterMinValue;
    }

    public function setBanktransterMinValue(string $banktransterMinValue): self
    {
        $this->banktransterMinValue = $banktransterMinValue;

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

    public function getMemberTransferFee(): ?int
    {
        return $this->memberTransferFee;
    }

    public function setMemberTransferFee(int $memberTransferFee): self
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

    public function getMinforstockalert(): ?bool
    {
        return $this->minforstockalert;
    }

    public function setMinforstockalert(bool $minforstockalert): self
    {
        $this->minforstockalert = $minforstockalert;

        return $this;
    }

    public function getThaivat(): ?string
    {
        return $this->thaivat;
    }

    public function setThaivat(?string $thaivat): self
    {
        $this->thaivat = $thaivat;

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

    public function getMasterkey(): ?string
    {
        return $this->masterkey;
    }

    public function setMasterkey(?string $masterkey): self
    {
        $this->masterkey = $masterkey;

        return $this;
    }


}
