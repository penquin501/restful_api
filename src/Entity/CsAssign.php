<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CsAssign
 *
 * @ORM\Table(name="CS_ASSIGN")
 * @ORM\Entity
 */
class CsAssign
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
     * @var int
     *
     * @ORM\Column(name="assigned_from", type="integer", nullable=false)
     */
    private $assignedFrom;

    /**
     * @var int
     *
     * @ORM\Column(name="assigned_to", type="integer", nullable=false)
     */
    private $assignedTo;

    /**
     * @var int
     *
     * @ORM\Column(name="assign_merchant", type="integer", nullable=false)
     */
    private $assignMerchant;

    /**
     * @var string
     *
     * @ORM\Column(name="assigned_invoice", type="string", length=1000, nullable=false)
     */
    private $assignedInvoice;

    /**
     * @var string
     *
     * @ORM\Column(name="assign_subinvoice", type="string", length=20, nullable=false)
     */
    private $assignSubinvoice;

    /**
     * @var int
     *
     * @ORM\Column(name="assigned_condition", type="integer", nullable=false)
     */
    private $assignedCondition;

    /**
     * @var string
     *
     * @ORM\Column(name="assigned_status", type="string", length=0, nullable=false)
     */
    private $assignedStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="assign_datetime", type="datetime", nullable=false)
     */
    private $assignDatetime;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getAssignedFrom(): ?int
    {
        return $this->assignedFrom;
    }

    public function setAssignedFrom(int $assignedFrom): self
    {
        $this->assignedFrom = $assignedFrom;

        return $this;
    }

    public function getAssignedTo(): ?int
    {
        return $this->assignedTo;
    }

    public function setAssignedTo(int $assignedTo): self
    {
        $this->assignedTo = $assignedTo;

        return $this;
    }

    public function getAssignMerchant(): ?int
    {
        return $this->assignMerchant;
    }

    public function setAssignMerchant(int $assignMerchant): self
    {
        $this->assignMerchant = $assignMerchant;

        return $this;
    }

    public function getAssignedInvoice(): ?string
    {
        return $this->assignedInvoice;
    }

    public function setAssignedInvoice(string $assignedInvoice): self
    {
        $this->assignedInvoice = $assignedInvoice;

        return $this;
    }

    public function getAssignSubinvoice(): ?string
    {
        return $this->assignSubinvoice;
    }

    public function setAssignSubinvoice(string $assignSubinvoice): self
    {
        $this->assignSubinvoice = $assignSubinvoice;

        return $this;
    }

    public function getAssignedCondition(): ?int
    {
        return $this->assignedCondition;
    }

    public function setAssignedCondition(int $assignedCondition): self
    {
        $this->assignedCondition = $assignedCondition;

        return $this;
    }

    public function getAssignedStatus(): ?string
    {
        return $this->assignedStatus;
    }

    public function setAssignedStatus(string $assignedStatus): self
    {
        $this->assignedStatus = $assignedStatus;

        return $this;
    }

    public function getAssignDatetime(): ?\DateTimeInterface
    {
        return $this->assignDatetime;
    }

    public function setAssignDatetime(\DateTimeInterface $assignDatetime): self
    {
        $this->assignDatetime = $assignDatetime;

        return $this;
    }


}
