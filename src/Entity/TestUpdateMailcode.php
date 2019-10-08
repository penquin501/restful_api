<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestUpdateMailcode
 *
 * @ORM\Table(name="test_update_mailcode", indexes={@ORM\Index(name="takeorderby", columns={"takeorderby", "payment_invoice"}), @ORM\Index(name="subinv", columns={"subinv"})})
 * @ORM\Entity
 */
class TestUpdateMailcode
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
     * @var int
     *
     * @ORM\Column(name="takeorderby", type="integer", nullable=false)
     */
    private $takeorderby;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_invoice", type="string", length=25, nullable=false)
     */
    private $paymentInvoice;

    /**
     * @var string
     *
     * @ORM\Column(name="subinv", type="string", length=20, nullable=false)
     */
    private $subinv;

    /**
     * @var string
     *
     * @ORM\Column(name="tracking", type="string", length=20, nullable=false)
     */
    private $tracking;

    public function getId(): ?int
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

    public function getSubinv(): ?string
    {
        return $this->subinv;
    }

    public function setSubinv(string $subinv): self
    {
        $this->subinv = $subinv;

        return $this;
    }

    public function getTracking(): ?string
    {
        return $this->tracking;
    }

    public function setTracking(string $tracking): self
    {
        $this->tracking = $tracking;

        return $this;
    }


}
