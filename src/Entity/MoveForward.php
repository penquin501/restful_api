<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MoveForward
 *
 * @ORM\Table(name="move_forward")
 * @ORM\Entity
 */
class MoveForward
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
     * @var string
     *
     * @ORM\Column(name="mailcode", type="string", length=12, nullable=false)
     */
    private $mailcode;

    /**
     * @var int
     *
     * @ORM\Column(name="take_from", type="integer", nullable=false)
     */
    private $takeFrom;

    /**
     * @var int
     *
     * @ORM\Column(name="take_to", type="integer", nullable=false)
     */
    private $takeTo;

    /**
     * @var int
     *
     * @ORM\Column(name="operation_by", type="integer", nullable=false)
     */
    private $operationBy;

    /**
     * @var string
     *
     * @ORM\Column(name="forward_type", type="string", length=0, nullable=false)
     */
    private $forwardType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_time_stamp", type="datetime", nullable=false)
     */
    private $dateTimeStamp;

    public function getId(): ?string
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

    public function getTakeFrom(): ?int
    {
        return $this->takeFrom;
    }

    public function setTakeFrom(int $takeFrom): self
    {
        $this->takeFrom = $takeFrom;

        return $this;
    }

    public function getTakeTo(): ?int
    {
        return $this->takeTo;
    }

    public function setTakeTo(int $takeTo): self
    {
        $this->takeTo = $takeTo;

        return $this;
    }

    public function getOperationBy(): ?int
    {
        return $this->operationBy;
    }

    public function setOperationBy(int $operationBy): self
    {
        $this->operationBy = $operationBy;

        return $this;
    }

    public function getForwardType(): ?string
    {
        return $this->forwardType;
    }

    public function setForwardType(string $forwardType): self
    {
        $this->forwardType = $forwardType;

        return $this;
    }

    public function getDateTimeStamp(): ?\DateTimeInterface
    {
        return $this->dateTimeStamp;
    }

    public function setDateTimeStamp(\DateTimeInterface $dateTimeStamp): self
    {
        $this->dateTimeStamp = $dateTimeStamp;

        return $this;
    }


}
