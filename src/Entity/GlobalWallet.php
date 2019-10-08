<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalWallet
 *
 * @ORM\Table(name="global_wallet")
 * @ORM\Entity
 */
class GlobalWallet
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
     * @ORM\Column(name="waller_id", type="integer", nullable=false)
     */
    private $wallerId;

    /**
     * @var string
     *
     * @ORM\Column(name="amount_val", type="decimal", precision=10, scale=4, nullable=false)
     */
    private $amountVal;

    /**
     * @var string
     *
     * @ORM\Column(name="direction", type="string", length=0, nullable=false)
     */
    private $direction;

    /**
     * @var string
     *
     * @ORM\Column(name="approve_code", type="string", length=12, nullable=false)
     */
    private $approveCode;

    /**
     * @var string
     *
     * @ORM\Column(name="transaction_from", type="string", length=0, nullable=false)
     */
    private $transactionFrom;

    /**
     * @var string
     *
     * @ORM\Column(name="addition_remark", type="string", length=100, nullable=false)
     */
    private $additionRemark;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_stamp", type="datetime", nullable=false)
     */
    private $timeStamp;

    /**
     * @var string
     *
     * @ORM\Column(name="Reconcile", type="string", length=50, nullable=false)
     */
    private $reconcile;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getWallerId(): ?int
    {
        return $this->wallerId;
    }

    public function setWallerId(int $wallerId): self
    {
        $this->wallerId = $wallerId;

        return $this;
    }

    public function getAmountVal(): ?string
    {
        return $this->amountVal;
    }

    public function setAmountVal(string $amountVal): self
    {
        $this->amountVal = $amountVal;

        return $this;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function setDirection(string $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    public function getApproveCode(): ?string
    {
        return $this->approveCode;
    }

    public function setApproveCode(string $approveCode): self
    {
        $this->approveCode = $approveCode;

        return $this;
    }

    public function getTransactionFrom(): ?string
    {
        return $this->transactionFrom;
    }

    public function setTransactionFrom(string $transactionFrom): self
    {
        $this->transactionFrom = $transactionFrom;

        return $this;
    }

    public function getAdditionRemark(): ?string
    {
        return $this->additionRemark;
    }

    public function setAdditionRemark(string $additionRemark): self
    {
        $this->additionRemark = $additionRemark;

        return $this;
    }

    public function getTimeStamp(): ?\DateTimeInterface
    {
        return $this->timeStamp;
    }

    public function setTimeStamp(\DateTimeInterface $timeStamp): self
    {
        $this->timeStamp = $timeStamp;

        return $this;
    }

    public function getReconcile(): ?string
    {
        return $this->reconcile;
    }

    public function setReconcile(string $reconcile): self
    {
        $this->reconcile = $reconcile;

        return $this;
    }


}
