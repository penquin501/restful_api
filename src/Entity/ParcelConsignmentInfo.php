<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParcelConsignmentInfo
 *
 * @ORM\Table(name="parcel_consignment_info", indexes={@ORM\Index(name="idx_sender_phoneno", columns={"senderphone"}), @ORM\Index(name="sender_info_idx", columns={"takeorderby", "payment_invoice"}), @ORM\Index(name="idx_sendername", columns={"sendername"})})
 * @ORM\Entity
 */
class ParcelConsignmentInfo
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
     * @var string|null
     *
     * @ORM\Column(name="courierpid", type="string", length=13, nullable=true)
     */
    private $courierpid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="courierimage", type="string", length=100, nullable=true)
     */
    private $courierimage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sendername", type="string", length=200, nullable=true)
     */
    private $sendername;

    /**
     * @var string|null
     *
     * @ORM\Column(name="senderphone", type="string", length=12, nullable=true)
     */
    private $senderphone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="senderaddr", type="string", length=1000, nullable=true)
     */
    private $senderaddr;

    public function getId(): ?int
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

    public function getCourierpid(): ?string
    {
        return $this->courierpid;
    }

    public function setCourierpid(?string $courierpid): self
    {
        $this->courierpid = $courierpid;

        return $this;
    }

    public function getCourierimage(): ?string
    {
        return $this->courierimage;
    }

    public function setCourierimage(?string $courierimage): self
    {
        $this->courierimage = $courierimage;

        return $this;
    }

    public function getSendername(): ?string
    {
        return $this->sendername;
    }

    public function setSendername(?string $sendername): self
    {
        $this->sendername = $sendername;

        return $this;
    }

    public function getSenderphone(): ?string
    {
        return $this->senderphone;
    }

    public function setSenderphone(?string $senderphone): self
    {
        $this->senderphone = $senderphone;

        return $this;
    }

    public function getSenderaddr(): ?string
    {
        return $this->senderaddr;
    }

    public function setSenderaddr(?string $senderaddr): self
    {
        $this->senderaddr = $senderaddr;

        return $this;
    }


}
