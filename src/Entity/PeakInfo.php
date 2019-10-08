<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PeakInfo
 *
 * @ORM\Table(name="peak_info")
 * @ORM\Entity
 */
class PeakInfo
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
     * @ORM\Column(name="idvalue", type="string", length=150, nullable=false)
     */
    private $idvalue;

    /**
     * @var string
     *
     * @ORM\Column(name="namevalue", type="string", length=25, nullable=false)
     */
    private $namevalue;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updatetimestamp", type="datetime", nullable=true)
     */
    private $updatetimestamp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdvalue(): ?string
    {
        return $this->idvalue;
    }

    public function setIdvalue(string $idvalue): self
    {
        $this->idvalue = $idvalue;

        return $this;
    }

    public function getNamevalue(): ?string
    {
        return $this->namevalue;
    }

    public function setNamevalue(string $namevalue): self
    {
        $this->namevalue = $namevalue;

        return $this;
    }

    public function getUpdatetimestamp(): ?\DateTimeInterface
    {
        return $this->updatetimestamp;
    }

    public function setUpdatetimestamp(?\DateTimeInterface $updatetimestamp): self
    {
        $this->updatetimestamp = $updatetimestamp;

        return $this;
    }


}
