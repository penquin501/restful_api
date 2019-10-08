<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CsAssignCondition
 *
 * @ORM\Table(name="CS_ASSIGN_CONDITION")
 * @ORM\Entity
 */
class CsAssignCondition
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
     * @ORM\Column(name="mer_id", type="string", length=1000, nullable=false)
     */
    private $merId;

    /**
     * @var string
     *
     * @ORM\Column(name="condition_focus", type="string", length=0, nullable=false, options={"default"="all of order"})
     */
    private $conditionFocus = 'all of order';

    /**
     * @var string|null
     *
     * @ORM\Column(name="condition_info", type="string", length=3000, nullable=true)
     */
    private $conditionInfo;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="condition_datetime_begin", type="datetime", nullable=true)
     */
    private $conditionDatetimeBegin;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="condition_datetime_end", type="datetime", nullable=true)
     */
    private $conditionDatetimeEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="condition_status", type="string", length=0, nullable=false, options={"default"="active"})
     */
    private $conditionStatus = 'active';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMerId(): ?string
    {
        return $this->merId;
    }

    public function setMerId(string $merId): self
    {
        $this->merId = $merId;

        return $this;
    }

    public function getConditionFocus(): ?string
    {
        return $this->conditionFocus;
    }

    public function setConditionFocus(string $conditionFocus): self
    {
        $this->conditionFocus = $conditionFocus;

        return $this;
    }

    public function getConditionInfo(): ?string
    {
        return $this->conditionInfo;
    }

    public function setConditionInfo(?string $conditionInfo): self
    {
        $this->conditionInfo = $conditionInfo;

        return $this;
    }

    public function getConditionDatetimeBegin(): ?\DateTimeInterface
    {
        return $this->conditionDatetimeBegin;
    }

    public function setConditionDatetimeBegin(?\DateTimeInterface $conditionDatetimeBegin): self
    {
        $this->conditionDatetimeBegin = $conditionDatetimeBegin;

        return $this;
    }

    public function getConditionDatetimeEnd(): ?\DateTimeInterface
    {
        return $this->conditionDatetimeEnd;
    }

    public function setConditionDatetimeEnd(?\DateTimeInterface $conditionDatetimeEnd): self
    {
        $this->conditionDatetimeEnd = $conditionDatetimeEnd;

        return $this;
    }

    public function getConditionStatus(): ?string
    {
        return $this->conditionStatus;
    }

    public function setConditionStatus(string $conditionStatus): self
    {
        $this->conditionStatus = $conditionStatus;

        return $this;
    }


}
