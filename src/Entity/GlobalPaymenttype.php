<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalPaymenttype
 *
 * @ORM\Table(name="global_paymenttype", indexes={@ORM\Index(name="paymentvalue", columns={"paymentvalue"})})
 * @ORM\Entity
 */
class GlobalPaymenttype
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
     * @ORM\Column(name="paymentname_en", type="string", length=50, nullable=false)
     */
    private $paymentnameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="paymentname_th", type="string", length=50, nullable=false)
     */
    private $paymentnameTh;

    /**
     * @var string
     *
     * @ORM\Column(name="paymentvalue", type="string", length=15, nullable=false)
     */
    private $paymentvalue;

    /**
     * @var string
     *
     * @ORM\Column(name="peak_value", type="string", length=100, nullable=false)
     */
    private $peakValue;

    /**
     * @var bool
     *
     * @ORM\Column(name="servicecare", type="boolean", nullable=false)
     */
    private $servicecare = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $active = '1';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentnameEn(): ?string
    {
        return $this->paymentnameEn;
    }

    public function setPaymentnameEn(string $paymentnameEn): self
    {
        $this->paymentnameEn = $paymentnameEn;

        return $this;
    }

    public function getPaymentnameTh(): ?string
    {
        return $this->paymentnameTh;
    }

    public function setPaymentnameTh(string $paymentnameTh): self
    {
        $this->paymentnameTh = $paymentnameTh;

        return $this;
    }

    public function getPaymentvalue(): ?string
    {
        return $this->paymentvalue;
    }

    public function setPaymentvalue(string $paymentvalue): self
    {
        $this->paymentvalue = $paymentvalue;

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

    public function getServicecare(): ?bool
    {
        return $this->servicecare;
    }

    public function setServicecare(bool $servicecare): self
    {
        $this->servicecare = $servicecare;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }


}
