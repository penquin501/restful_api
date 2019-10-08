<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalStatementCode
 *
 * @ORM\Table(name="global_statement_code", indexes={@ORM\Index(name="idx_hashkey", columns={"hashkey"})})
 * @ORM\Entity
 */
class GlobalStatementCode
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
     * @var string|null
     *
     * @ORM\Column(name="billingno", type="string", length=30, nullable=true)
     */
    private $billingno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hashkey", type="string", length=500, nullable=true)
     */
    private $hashkey;

    /**
     * @var int|null
     *
     * @ORM\Column(name="merid", type="integer", nullable=true)
     */
    private $merid;

    /**
     * @var string
     *
     * @ORM\Column(name="servicefee", type="decimal", precision=3, scale=2, nullable=false)
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="effectivedate", type="datetime", nullable=true)
     */
    private $effectivedate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="transferdate", type="datetime", nullable=true)
     */
    private $transferdate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=0, nullable=true)
     */
    private $status;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getBillingno(): ?string
    {
        return $this->billingno;
    }

    public function setBillingno(?string $billingno): self
    {
        $this->billingno = $billingno;

        return $this;
    }

    public function getHashkey(): ?string
    {
        return $this->hashkey;
    }

    public function setHashkey(?string $hashkey): self
    {
        $this->hashkey = $hashkey;

        return $this;
    }

    public function getMerid(): ?int
    {
        return $this->merid;
    }

    public function setMerid(?int $merid): self
    {
        $this->merid = $merid;

        return $this;
    }

    public function getServicefee(): ?string
    {
        return $this->servicefee;
    }

    public function setServicefee(string $servicefee): self
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

    public function getEffectivedate(): ?\DateTimeInterface
    {
        return $this->effectivedate;
    }

    public function setEffectivedate(?\DateTimeInterface $effectivedate): self
    {
        $this->effectivedate = $effectivedate;

        return $this;
    }

    public function getTransferdate(): ?\DateTimeInterface
    {
        return $this->transferdate;
    }

    public function setTransferdate(?\DateTimeInterface $transferdate): self
    {
        $this->transferdate = $transferdate;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }


}
