<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalProductImage
 *
 * @ORM\Table(name="global_product_image", indexes={@ORM\Index(name="productcode_takeorderby_idx", columns={"productcode", "createby"}), @ORM\Index(name="productcode_takeorderby_mainimage_indeximage_idx", columns={"productcode", "createby", "mainimage", "indeximage"}), @ORM\Index(name="takeorderby_idx", columns={"createby"})})
 * @ORM\Entity
 */
class GlobalProductImage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="createby", type="integer", nullable=false)
     */
    private $createby;

    /**
     * @var int
     *
     * @ORM\Column(name="productcode", type="integer", nullable=false)
     */
    private $productcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imagename", type="string", length=300, nullable=true)
     */
    private $imagename;

    /**
     * @var string|null
     *
     * @ORM\Column(name="thumbimg", type="string", length=300, nullable=true)
     */
    private $thumbimg;

    /**
     * @var bool
     *
     * @ORM\Column(name="mainimage", type="boolean", nullable=false)
     */
    private $mainimage;

    /**
     * @var bool
     *
     * @ORM\Column(name="indeximage", type="boolean", nullable=false)
     */
    private $indeximage;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCreateby(): ?int
    {
        return $this->createby;
    }

    public function setCreateby(int $createby): self
    {
        $this->createby = $createby;

        return $this;
    }

    public function getProductcode(): ?int
    {
        return $this->productcode;
    }

    public function setProductcode(int $productcode): self
    {
        $this->productcode = $productcode;

        return $this;
    }

    public function getImagename(): ?string
    {
        return $this->imagename;
    }

    public function setImagename(?string $imagename): self
    {
        $this->imagename = $imagename;

        return $this;
    }

    public function getThumbimg(): ?string
    {
        return $this->thumbimg;
    }

    public function setThumbimg(?string $thumbimg): self
    {
        $this->thumbimg = $thumbimg;

        return $this;
    }

    public function getMainimage(): ?bool
    {
        return $this->mainimage;
    }

    public function setMainimage(bool $mainimage): self
    {
        $this->mainimage = $mainimage;

        return $this;
    }

    public function getIndeximage(): ?bool
    {
        return $this->indeximage;
    }

    public function setIndeximage(bool $indeximage): self
    {
        $this->indeximage = $indeximage;

        return $this;
    }


}
