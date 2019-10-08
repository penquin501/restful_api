<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogParcelTool
 *
 * @ORM\Table(name="log_parcel_tool")
 * @ORM\Entity
 */
class LogParcelTool
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
     * @ORM\Column(name="usersign", type="string", length=20, nullable=false)
     */
    private $usersign;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_into_system", type="datetime", nullable=false)
     */
    private $timeIntoSystem;

    /**
     * @var string
     *
     * @ORM\Column(name="previous_value", type="string", length=255, nullable=false)
     */
    private $previousValue;

    /**
     * @var string
     *
     * @ORM\Column(name="current_value", type="string", length=255, nullable=false)
     */
    private $currentValue;

    /**
     * @var string
     *
     * @ORM\Column(name="module_name", type="string", length=255, nullable=false)
     */
    private $moduleName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="payment_invoice", type="string", length=16, nullable=true)
     */
    private $paymentInvoice;

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

    public function getUsersign(): ?string
    {
        return $this->usersign;
    }

    public function setUsersign(string $usersign): self
    {
        $this->usersign = $usersign;

        return $this;
    }

    public function getTimeIntoSystem(): ?\DateTimeInterface
    {
        return $this->timeIntoSystem;
    }

    public function setTimeIntoSystem(\DateTimeInterface $timeIntoSystem): self
    {
        $this->timeIntoSystem = $timeIntoSystem;

        return $this;
    }

    public function getPreviousValue(): ?string
    {
        return $this->previousValue;
    }

    public function setPreviousValue(string $previousValue): self
    {
        $this->previousValue = $previousValue;

        return $this;
    }

    public function getCurrentValue(): ?string
    {
        return $this->currentValue;
    }

    public function setCurrentValue(string $currentValue): self
    {
        $this->currentValue = $currentValue;

        return $this;
    }

    public function getModuleName(): ?string
    {
        return $this->moduleName;
    }

    public function setModuleName(string $moduleName): self
    {
        $this->moduleName = $moduleName;

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


}
