<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalGenTrackingNo
 *
 * @ORM\Table(name="global_gen_tracking_no", indexes={@ORM\Index(name="idx_prefix", columns={"prefix", "yearstamp", "subfix", "running_no"}), @ORM\Index(name="idx_running_no", columns={"running_no"})})
 * @ORM\Entity
 */
class GlobalGenTrackingNo
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
     * @var \DateTime
     *
     * @ORM\Column(name="datestamp", type="datetime", nullable=false)
     */
    private $datestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="prefix", type="string", length=3, nullable=false)
     */
    private $prefix;

    /**
     * @var bool
     *
     * @ORM\Column(name="yearstamp", type="boolean", nullable=false)
     */
    private $yearstamp;

    /**
     * @var string
     *
     * @ORM\Column(name="subfix", type="string", length=1, nullable=false)
     */
    private $subfix;

    /**
     * @var int
     *
     * @ORM\Column(name="running_no", type="integer", nullable=false)
     */
    private $runningNo;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDatestamp(): ?\DateTimeInterface
    {
        return $this->datestamp;
    }

    public function setDatestamp(\DateTimeInterface $datestamp): self
    {
        $this->datestamp = $datestamp;

        return $this;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function setPrefix(string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getYearstamp(): ?bool
    {
        return $this->yearstamp;
    }

    public function setYearstamp(bool $yearstamp): self
    {
        $this->yearstamp = $yearstamp;

        return $this;
    }

    public function getSubfix(): ?string
    {
        return $this->subfix;
    }

    public function setSubfix(string $subfix): self
    {
        $this->subfix = $subfix;

        return $this;
    }

    public function getRunningNo(): ?int
    {
        return $this->runningNo;
    }

    public function setRunningNo(int $runningNo): self
    {
        $this->runningNo = $runningNo;

        return $this;
    }


}
