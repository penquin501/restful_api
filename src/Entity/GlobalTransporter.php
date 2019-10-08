<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalTransporter
 *
 * @ORM\Table(name="global_transporter")
 * @ORM\Entity
 */
class GlobalTransporter
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
     * @ORM\Column(name="transporter_name", type="string", length=100, nullable=false)
     */
    private $transporterName;

    /**
     * @var string
     *
     * @ORM\Column(name="dbcolumn_name", type="string", length=100, nullable=false)
     */
    private $dbcolumnName;

    /**
     * @var int
     *
     * @ORM\Column(name="priority", type="smallint", nullable=false)
     */
    private $priority = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="default_prefix", type="string", length=3, nullable=false)
     */
    private $defaultPrefix;

    /**
     * @var string
     *
     * @ORM\Column(name="regexp_consignment", type="string", length=100, nullable=false)
     */
    private $regexpConsignment;

    /**
     * @var bool
     *
     * @ORM\Column(name="maxsize_support", type="boolean", nullable=false, options={"default"="2"})
     */
    private $maxsizeSupport = '2';

    /**
     * @var string|null
     *
     * @ORM\Column(name="tracking_url", type="string", length=255, nullable=true)
     */
    private $trackingUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=0, nullable=false, options={"default"="active"})
     */
    private $status = 'active';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransporterName(): ?string
    {
        return $this->transporterName;
    }

    public function setTransporterName(string $transporterName): self
    {
        $this->transporterName = $transporterName;

        return $this;
    }

    public function getDbcolumnName(): ?string
    {
        return $this->dbcolumnName;
    }

    public function setDbcolumnName(string $dbcolumnName): self
    {
        $this->dbcolumnName = $dbcolumnName;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getDefaultPrefix(): ?string
    {
        return $this->defaultPrefix;
    }

    public function setDefaultPrefix(string $defaultPrefix): self
    {
        $this->defaultPrefix = $defaultPrefix;

        return $this;
    }

    public function getRegexpConsignment(): ?string
    {
        return $this->regexpConsignment;
    }

    public function setRegexpConsignment(string $regexpConsignment): self
    {
        $this->regexpConsignment = $regexpConsignment;

        return $this;
    }

    public function getMaxsizeSupport(): ?bool
    {
        return $this->maxsizeSupport;
    }

    public function setMaxsizeSupport(bool $maxsizeSupport): self
    {
        $this->maxsizeSupport = $maxsizeSupport;

        return $this;
    }

    public function getTrackingUrl(): ?string
    {
        return $this->trackingUrl;
    }

    public function setTrackingUrl(?string $trackingUrl): self
    {
        $this->trackingUrl = $trackingUrl;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }


}
