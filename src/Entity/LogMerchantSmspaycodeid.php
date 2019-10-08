<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogMerchantSmspaycodeid
 *
 * @ORM\Table(name="log_merchant_smspaycodeid")
 * @ORM\Entity
 */
class LogMerchantSmspaycodeid
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=250, nullable=false)
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
     * @ORM\Column(name="payment_invoice", type="string", length=50, nullable=false)
     */
    private $paymentInvoice;

    /**
     * @var string
     *
     * @ORM\Column(name="smsid", type="string", length=100, nullable=false)
     */
    private $smsid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="logtimestamp", type="datetime", nullable=false)
     */
    private $logtimestamp;

    public function getId(): ?string
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

    public function getSmsid(): ?string
    {
        return $this->smsid;
    }

    public function setSmsid(string $smsid): self
    {
        $this->smsid = $smsid;

        return $this;
    }

    public function getLogtimestamp(): ?\DateTimeInterface
    {
        return $this->logtimestamp;
    }

    public function setLogtimestamp(\DateTimeInterface $logtimestamp): self
    {
        $this->logtimestamp = $logtimestamp;

        return $this;
    }


}
