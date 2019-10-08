<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CsAssignStatusLog
 *
 * @ORM\Table(name="CS_ASSIGN_STATUS_LOG")
 * @ORM\Entity
 */
class CsAssignStatusLog
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
     * @ORM\Column(name="assigned_id", type="bigint", nullable=false)
     */
    private $assignedId;

    /**
     * @var string
     *
     * @ORM\Column(name="assigned_status", type="string", length=0, nullable=false)
     */
    private $assignedStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="assigned_status_note", type="string", length=1000, nullable=false)
     */
    private $assignedStatusNote;

    /**
     * @var int
     *
     * @ORM\Column(name="assigned_to", type="integer", nullable=false)
     */
    private $assignedTo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="shange_status_datetime", type="datetime", nullable=false)
     */
    private $shangeStatusDatetime;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getAssignedId(): ?string
    {
        return $this->assignedId;
    }

    public function setAssignedId(string $assignedId): self
    {
        $this->assignedId = $assignedId;

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

    public function getAssignedStatusNote(): ?string
    {
        return $this->assignedStatusNote;
    }

    public function setAssignedStatusNote(string $assignedStatusNote): self
    {
        $this->assignedStatusNote = $assignedStatusNote;

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

    public function getShangeStatusDatetime(): ?\DateTimeInterface
    {
        return $this->shangeStatusDatetime;
    }

    public function setShangeStatusDatetime(\DateTimeInterface $shangeStatusDatetime): self
    {
        $this->shangeStatusDatetime = $shangeStatusDatetime;

        return $this;
    }


}
