<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CheckParcelDrop
 *
 * @ORM\Table(name="check_parcel_drop")
 * @ORM\Entity
 */
class CheckParcelDrop
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
     * @var int|null
     *
     * @ORM\Column(name="agent_user_id", type="integer", nullable=true)
     */
    private $agentUserId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="mer_id", type="integer", nullable=true)
     */
    private $merId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="payment_invoice", type="string", length=20, nullable=true)
     */
    private $paymentInvoice;

    /**
     * @var string|null
     *
     * @ORM\Column(name="parcel_ref", type="string", length=20, nullable=true)
     */
    private $parcelRef;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_drop", type="datetime", nullable=true)
     */
    private $dateDrop;

    /**
     * @var int|null
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @var int|null
     *
     * @ORM\Column(name="drop_mer_id", type="integer", nullable=true)
     */
    private $dropMerId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAgentUserId(): ?int
    {
        return $this->agentUserId;
    }

    public function setAgentUserId(?int $agentUserId): self
    {
        $this->agentUserId = $agentUserId;

        return $this;
    }

    public function getMerId(): ?int
    {
        return $this->merId;
    }

    public function setMerId(?int $merId): self
    {
        $this->merId = $merId;

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

    public function getParcelRef(): ?string
    {
        return $this->parcelRef;
    }

    public function setParcelRef(?string $parcelRef): self
    {
        $this->parcelRef = $parcelRef;

        return $this;
    }

    public function getDateDrop(): ?\DateTimeInterface
    {
        return $this->dateDrop;
    }

    public function setDateDrop(?\DateTimeInterface $dateDrop): self
    {
        $this->dateDrop = $dateDrop;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDropMerId(): ?int
    {
        return $this->dropMerId;
    }

    public function setDropMerId(?int $dropMerId): self
    {
        $this->dropMerId = $dropMerId;

        return $this;
    }


}
