<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MerchantApiTransferCod
 *
 * @ORM\Table(name="merchant_api_transfer_cod", uniqueConstraints={@ORM\UniqueConstraint(name="mailcode", columns={"mailcode"})}, indexes={@ORM\Index(name="mailcode_2", columns={"mailcode"})})
 * @ORM\Entity
 */
class MerchantApiTransferCod
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
     * @ORM\Column(name="mailcode", type="string", length=30, nullable=false)
     */
    private $mailcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="transfer_status", type="string", length=2, nullable=true)
     */
    private $transferStatus;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="transfer_date", type="date", nullable=true)
     */
    private $transferDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bill_amt", type="decimal", precision=10, scale=4, nullable=true)
     */
    private $billAmt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cod_fee", type="decimal", precision=10, scale=4, nullable=true)
     */
    private $codFee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="transfer_amt", type="decimal", precision=10, scale=4, nullable=true)
     */
    private $transferAmt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMailcode(): ?string
    {
        return $this->mailcode;
    }

    public function setMailcode(string $mailcode): self
    {
        $this->mailcode = $mailcode;

        return $this;
    }

    public function getTransferStatus(): ?string
    {
        return $this->transferStatus;
    }

    public function setTransferStatus(?string $transferStatus): self
    {
        $this->transferStatus = $transferStatus;

        return $this;
    }

    public function getTransferDate(): ?\DateTimeInterface
    {
        return $this->transferDate;
    }

    public function setTransferDate(?\DateTimeInterface $transferDate): self
    {
        $this->transferDate = $transferDate;

        return $this;
    }

    public function getBillAmt(): ?string
    {
        return $this->billAmt;
    }

    public function setBillAmt(?string $billAmt): self
    {
        $this->billAmt = $billAmt;

        return $this;
    }

    public function getCodFee(): ?string
    {
        return $this->codFee;
    }

    public function setCodFee(?string $codFee): self
    {
        $this->codFee = $codFee;

        return $this;
    }

    public function getTransferAmt(): ?string
    {
        return $this->transferAmt;
    }

    public function setTransferAmt(?string $transferAmt): self
    {
        $this->transferAmt = $transferAmt;

        return $this;
    }


}
