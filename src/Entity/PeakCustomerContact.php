<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PeakCustomerContact
 *
 * @ORM\Table(name="peak_customer_contact", indexes={@ORM\Index(name="idx_custname", columns={"cust_name"})})
 * @ORM\Entity
 */
class PeakCustomerContact
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
     * @ORM\Column(name="peak_code", type="string", length=16, nullable=false)
     */
    private $peakCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cust_name", type="string", length=100, nullable=true)
     */
    private $custName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="peak_value", type="string", length=100, nullable=true)
     */
    private $peakValue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeakCode(): ?string
    {
        return $this->peakCode;
    }

    public function setPeakCode(string $peakCode): self
    {
        $this->peakCode = $peakCode;

        return $this;
    }

    public function getCustName(): ?string
    {
        return $this->custName;
    }

    public function setCustName(?string $custName): self
    {
        $this->custName = $custName;

        return $this;
    }

    public function getPeakValue(): ?string
    {
        return $this->peakValue;
    }

    public function setPeakValue(?string $peakValue): self
    {
        $this->peakValue = $peakValue;

        return $this;
    }


}
