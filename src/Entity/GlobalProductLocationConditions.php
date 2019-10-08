<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalProductLocationConditions
 *
 * @ORM\Table(name="global_product_location_conditions")
 * @ORM\Entity
 */
class GlobalProductLocationConditions
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
     * @ORM\Column(name="location_code", type="text", length=16777215, nullable=false)
     */
    private $locationCode;

    /**
     * @var int
     *
     * @ORM\Column(name="global_product_id", type="integer", nullable=false)
     */
    private $globalProductId;

    /**
     * @var string
     *
     * @ORM\Column(name="specific_type", type="string", length=0, nullable=false, options={"default"="all"})
     */
    private $specificType = 'all';

    /**
     * @var string|null
     *
     * @ORM\Column(name="permit", type="string", length=0, nullable=true, options={"default"="allow"})
     */
    private $permit = 'allow';

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

    public function getLocationCode(): ?string
    {
        return $this->locationCode;
    }

    public function setLocationCode(string $locationCode): self
    {
        $this->locationCode = $locationCode;

        return $this;
    }

    public function getGlobalProductId(): ?int
    {
        return $this->globalProductId;
    }

    public function setGlobalProductId(int $globalProductId): self
    {
        $this->globalProductId = $globalProductId;

        return $this;
    }

    public function getSpecificType(): ?string
    {
        return $this->specificType;
    }

    public function setSpecificType(string $specificType): self
    {
        $this->specificType = $specificType;

        return $this;
    }

    public function getPermit(): ?string
    {
        return $this->permit;
    }

    public function setPermit(?string $permit): self
    {
        $this->permit = $permit;

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
