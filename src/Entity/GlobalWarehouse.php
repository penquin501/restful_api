<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalWarehouse
 *
 * @ORM\Table(name="global_warehouse")
 * @ORM\Entity
 */
class GlobalWarehouse
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
     * @ORM\Column(name="warehouse_name", type="string", length=200, nullable=false)
     */
    private $warehouseName;

    /**
     * @var string
     *
     * @ORM\Column(name="warehouse_url", type="string", length=300, nullable=false)
     */
    private $warehouseUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="warehouse_apikey", type="string", length=100, nullable=false)
     */
    private $warehouseApikey;

    /**
     * @var string
     *
     * @ORM\Column(name="warehouse_tier", type="string", length=0, nullable=false, options={"default"="firsttier"})
     */
    private $warehouseTier = 'firsttier';

    /**
     * @var string
     *
     * @ORM\Column(name="warehouse_status", type="string", length=0, nullable=false, options={"default"="active"})
     */
    private $warehouseStatus = 'active';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWarehouseName(): ?string
    {
        return $this->warehouseName;
    }

    public function setWarehouseName(string $warehouseName): self
    {
        $this->warehouseName = $warehouseName;

        return $this;
    }

    public function getWarehouseUrl(): ?string
    {
        return $this->warehouseUrl;
    }

    public function setWarehouseUrl(string $warehouseUrl): self
    {
        $this->warehouseUrl = $warehouseUrl;

        return $this;
    }

    public function getWarehouseApikey(): ?string
    {
        return $this->warehouseApikey;
    }

    public function setWarehouseApikey(string $warehouseApikey): self
    {
        $this->warehouseApikey = $warehouseApikey;

        return $this;
    }

    public function getWarehouseTier(): ?string
    {
        return $this->warehouseTier;
    }

    public function setWarehouseTier(string $warehouseTier): self
    {
        $this->warehouseTier = $warehouseTier;

        return $this;
    }

    public function getWarehouseStatus(): ?string
    {
        return $this->warehouseStatus;
    }

    public function setWarehouseStatus(string $warehouseStatus): self
    {
        $this->warehouseStatus = $warehouseStatus;

        return $this;
    }


}
