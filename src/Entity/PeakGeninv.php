<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PeakGeninv
 *
 * @ORM\Table(name="peak_geninv", indexes={@ORM\Index(name="takeorderby_geninvoice_idx", columns={"type", "geninvoice"})})
 * @ORM\Entity
 */
class PeakGeninv
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="datestamp", type="datetime", nullable=true)
     */
    private $datestamp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=10, nullable=true)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer", nullable=false)
     */
    private $year;

    /**
     * @var int|null
     *
     * @ORM\Column(name="geninvoice", type="bigint", nullable=true)
     */
    private $geninvoice;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDatestamp(): ?\DateTimeInterface
    {
        return $this->datestamp;
    }

    public function setDatestamp(?\DateTimeInterface $datestamp): self
    {
        $this->datestamp = $datestamp;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getGeninvoice(): ?string
    {
        return $this->geninvoice;
    }

    public function setGeninvoice(?string $geninvoice): self
    {
        $this->geninvoice = $geninvoice;

        return $this;
    }


}
