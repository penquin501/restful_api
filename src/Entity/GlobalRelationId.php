<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalRelationId
 *
 * @ORM\Table(name="global_relation_id", uniqueConstraints={@ORM\UniqueConstraint(name="warehouse_id", columns={"warehouse_id"})})
 * @ORM\Entity
 */
class GlobalRelationId
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
     * @var int
     *
     * @ORM\Column(name="owner_product_merchant_id", type="integer", nullable=false)
     */
    private $ownerProductMerchantId;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_parcel_member", type="string", length=20, nullable=false)
     */
    private $ownerParcelMember;

    /**
     * @var int
     *
     * @ORM\Column(name="warehouse_id", type="integer", nullable=false)
     */
    private $warehouseId;

    /**
     * @var int
     *
     * @ORM\Column(name="parcel_id", type="integer", nullable=false)
     */
    private $parcelId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwnerProductMerchantId(): ?int
    {
        return $this->ownerProductMerchantId;
    }

    public function setOwnerProductMerchantId(int $ownerProductMerchantId): self
    {
        $this->ownerProductMerchantId = $ownerProductMerchantId;

        return $this;
    }

    public function getOwnerParcelMember(): ?string
    {
        return $this->ownerParcelMember;
    }

    public function setOwnerParcelMember(string $ownerParcelMember): self
    {
        $this->ownerParcelMember = $ownerParcelMember;

        return $this;
    }

    public function getWarehouseId(): ?int
    {
        return $this->warehouseId;
    }

    public function setWarehouseId(int $warehouseId): self
    {
        $this->warehouseId = $warehouseId;

        return $this;
    }

    public function getParcelId(): ?int
    {
        return $this->parcelId;
    }

    public function setParcelId(int $parcelId): self
    {
        $this->parcelId = $parcelId;

        return $this;
    }


}
