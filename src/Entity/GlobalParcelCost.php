<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalParcelCost
 *
 * @ORM\Table(name="global_parcel_cost", indexes={@ORM\Index(name="size_name", columns={"size_name"}), @ORM\Index(name="box_type", columns={"box_type"}), @ORM\Index(name="global_product_id", columns={"global_product_id"}), @ORM\Index(name="area", columns={"area"})})
 * @ORM\Entity
 */
class GlobalParcelCost
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
     * @ORM\Column(name="global_product_id", type="integer", nullable=false)
     */
    private $globalProductId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="size_name", type="string", length=15, nullable=true)
     */
    private $sizeName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="area", type="string", length=0, nullable=true)
     */
    private $area;

    /**
     * @var string|null
     *
     * @ORM\Column(name="box_type", type="string", length=0, nullable=true)
     */
    private $boxType;

    /**
     * @var string
     *
     * @ORM\Column(name="cost_eb", type="decimal", precision=10, scale=0, nullable=false, options={"comment"="ecom"})
     */
    private $costEb;

    /**
     * @var string
     *
     * @ORM\Column(name="cost_fc", type="decimal", precision=10, scale=0, nullable=false, options={"comment"="franchise"})
     */
    private $costFc;

    /**
     * @var string
     *
     * @ORM\Column(name="cost_ag", type="decimal", precision=10, scale=0, nullable=false, options={"comment"="agent"})
     */
    private $costAg;

    /**
     * @var string
     *
     * @ORM\Column(name="cost_sh_ag", type="decimal", precision=10, scale=0, nullable=false, options={"comment"="shop_agent"})
     */
    private $costShAg;

    /**
     * @var string
     *
     * @ORM\Column(name="cost_su_ag", type="decimal", precision=10, scale=0, nullable=false, options={"comment"="sub_agent (under francise)"})
     */
    private $costSuAg;

    /**
     * @var string
     *
     * @ORM\Column(name="sale_price", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $salePrice;

    /**
     * @var int
     *
     * @ORM\Column(name="sale_price_ffm", type="integer", nullable=false)
     */
    private $salePriceFfm;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSizeName(): ?string
    {
        return $this->sizeName;
    }

    public function setSizeName(?string $sizeName): self
    {
        $this->sizeName = $sizeName;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(?string $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getBoxType(): ?string
    {
        return $this->boxType;
    }

    public function setBoxType(?string $boxType): self
    {
        $this->boxType = $boxType;

        return $this;
    }

    public function getCostEb(): ?string
    {
        return $this->costEb;
    }

    public function setCostEb(string $costEb): self
    {
        $this->costEb = $costEb;

        return $this;
    }

    public function getCostFc(): ?string
    {
        return $this->costFc;
    }

    public function setCostFc(string $costFc): self
    {
        $this->costFc = $costFc;

        return $this;
    }

    public function getCostAg(): ?string
    {
        return $this->costAg;
    }

    public function setCostAg(string $costAg): self
    {
        $this->costAg = $costAg;

        return $this;
    }

    public function getCostShAg(): ?string
    {
        return $this->costShAg;
    }

    public function setCostShAg(string $costShAg): self
    {
        $this->costShAg = $costShAg;

        return $this;
    }

    public function getCostSuAg(): ?string
    {
        return $this->costSuAg;
    }

    public function setCostSuAg(string $costSuAg): self
    {
        $this->costSuAg = $costSuAg;

        return $this;
    }

    public function getSalePrice(): ?string
    {
        return $this->salePrice;
    }

    public function setSalePrice(string $salePrice): self
    {
        $this->salePrice = $salePrice;

        return $this;
    }

    public function getSalePriceFfm(): ?int
    {
        return $this->salePriceFfm;
    }

    public function setSalePriceFfm(int $salePriceFfm): self
    {
        $this->salePriceFfm = $salePriceFfm;

        return $this;
    }


}
