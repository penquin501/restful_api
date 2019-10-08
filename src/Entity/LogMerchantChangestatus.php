<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogMerchantChangestatus
 *
 * @ORM\Table(name="log_merchant_changestatus", indexes={@ORM\Index(name="takeorderby", columns={"takeorderby", "payment_invoice"})})
 * @ORM\Entity
 */
class LogMerchantChangestatus
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
     * @var int|null
     *
     * @ORM\Column(name="takeorderby", type="integer", nullable=true)
     */
    private $takeorderby;

    /**
     * @var string|null
     *
     * @ORM\Column(name="usersign", type="string", length=100, nullable=true)
     */
    private $usersign;

    /**
     * @var string|null
     *
     * @ORM\Column(name="payment_invoice", type="string", length=25, nullable=true)
     */
    private $paymentInvoice;

    /**
     * @var string|null
     *
     * @ORM\Column(name="previousorderstatus", type="string", length=5, nullable=true)
     */
    private $previousorderstatus;

    /**
     * @var string|null
     *
     * @ORM\Column(name="currentorderstatus", type="string", length=5, nullable=true)
     */
    private $currentorderstatus;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="timetochange", type="datetime", nullable=true)
     */
    private $timetochange;

    /**
     * @var string|null
     *
     * @ORM\Column(name="changefrommodule", type="string", length=50, nullable=true)
     */
    private $changefrommodule;

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

    public function getUsersign(): ?string
    {
        return $this->usersign;
    }

    public function setUsersign(?string $usersign): self
    {
        $this->usersign = $usersign;

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

    public function getPreviousorderstatus(): ?string
    {
        return $this->previousorderstatus;
    }

    public function setPreviousorderstatus(?string $previousorderstatus): self
    {
        $this->previousorderstatus = $previousorderstatus;

        return $this;
    }

    public function getCurrentorderstatus(): ?string
    {
        return $this->currentorderstatus;
    }

    public function setCurrentorderstatus(?string $currentorderstatus): self
    {
        $this->currentorderstatus = $currentorderstatus;

        return $this;
    }

    public function getTimetochange(): ?\DateTimeInterface
    {
        return $this->timetochange;
    }

    public function setTimetochange(?\DateTimeInterface $timetochange): self
    {
        $this->timetochange = $timetochange;

        return $this;
    }

    public function getChangefrommodule(): ?string
    {
        return $this->changefrommodule;
    }

    public function setChangefrommodule(?string $changefrommodule): self
    {
        $this->changefrommodule = $changefrommodule;

        return $this;
    }


}
