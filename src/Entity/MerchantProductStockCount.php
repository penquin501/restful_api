<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MerchantProductStockCount
 *
 * @ORM\Table(name="merchant_product_stock_count")
 * @ORM\Entity
 */
class MerchantProductStockCount
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
     * @var int
     *
     * @ORM\Column(name="takeorderby", type="integer", nullable=false)
     */
    private $takeorderby;

    /**
     * @var int
     *
     * @ORM\Column(name="productid", type="integer", nullable=false)
     */
    private $productid;

    /**
     * @var int
     *
     * @ORM\Column(name="countitems", type="bigint", nullable=false)
     */
    private $countitems = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="timeupdate", type="datetime", nullable=true)
     */
    private $timeupdate;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTakeorderby(): ?int
    {
        return $this->takeorderby;
    }

    public function setTakeorderby(int $takeorderby): self
    {
        $this->takeorderby = $takeorderby;

        return $this;
    }

    public function getProductid(): ?int
    {
        return $this->productid;
    }

    public function setProductid(int $productid): self
    {
        $this->productid = $productid;

        return $this;
    }

    public function getCountitems(): ?string
    {
        return $this->countitems;
    }

    public function setCountitems(string $countitems): self
    {
        $this->countitems = $countitems;

        return $this;
    }

    public function getTimeupdate(): ?\DateTimeInterface
    {
        return $this->timeupdate;
    }

    public function setTimeupdate(?\DateTimeInterface $timeupdate): self
    {
        $this->timeupdate = $timeupdate;

        return $this;
    }


}
