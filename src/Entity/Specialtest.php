<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Specialtest
 *
 * @ORM\Table(name="_specialtest")
 * @ORM\Entity
 */
class Specialtest
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
     * @ORM\Column(name="merid", type="integer", nullable=false)
     */
    private $merid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inv", type="string", length=16, nullable=true)
     */
    private $inv;

    /**
     * @var string|null
     *
     * @ORM\Column(name="orderstatus", type="string", length=0, nullable=true)
     */
    private $orderstatus;

    /**
     * @var string|null
     *
     * @ORM\Column(name="payment_status", type="string", length=2, nullable=true)
     */
    private $paymentStatus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMerid(): ?int
    {
        return $this->merid;
    }

    public function setMerid(int $merid): self
    {
        $this->merid = $merid;

        return $this;
    }

    public function getInv(): ?string
    {
        return $this->inv;
    }

    public function setInv(?string $inv): self
    {
        $this->inv = $inv;

        return $this;
    }

    public function getOrderstatus(): ?string
    {
        return $this->orderstatus;
    }

    public function setOrderstatus(?string $orderstatus): self
    {
        $this->orderstatus = $orderstatus;

        return $this;
    }

    public function getPaymentStatus(): ?string
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus(?string $paymentStatus): self
    {
        $this->paymentStatus = $paymentStatus;

        return $this;
    }


}
