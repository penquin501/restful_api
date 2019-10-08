<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalProductStockCount1
 *
 * @ORM\Table(name="global_product_stock_count1", indexes={@ORM\Index(name="productid", columns={"productid"})})
 * @ORM\Entity
 */
class GlobalProductStockCount1
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
