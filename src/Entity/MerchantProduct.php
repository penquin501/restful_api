<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MerchantProduct
 *
 * @ORM\Table(name="merchant_product", indexes={@ORM\Index(name="idx_productname", columns={"productname"}), @ORM\Index(name="productid_idx", columns={"productid"}), @ORM\Index(name="takeorderby_idx", columns={"takeorderby"}), @ORM\Index(name="takeorderby_productid_idx", columns={"takeorderby", "productid"}), @ORM\Index(name="productsize", columns={"productsize"})})
 * @ORM\Entity
 */
class MerchantProduct
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
     * @ORM\Column(name="productid", type="integer", nullable=false)
     */
    private $productid;

    /**
     * @var string
     *
     * @ORM\Column(name="ext_productcode", type="string", length=100, nullable=false)
     */
    private $extProductcode;

    /**
     * @var int
     *
     * @ORM\Column(name="product_global_id", type="integer", nullable=false)
     */
    private $productGlobalId = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="takeorderby", type="integer", nullable=false)
     */
    private $takeorderby;

    /**
     * @var int|null
     *
     * @ORM\Column(name="createby", type="integer", nullable=true)
     */
    private $createby;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productname", type="string", length=120, nullable=true)
     */
    private $productname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productdetail", type="string", length=1500, nullable=true)
     */
    private $productdetail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productprice", type="decimal", precision=13, scale=2, nullable=true)
     */
    private $productprice;

    /**
     * @var string
     *
     * @ORM\Column(name="productstatus", type="string", length=0, nullable=false, options={"default"="active"})
     */
    private $productstatus = 'active';

    /**
     * @var string
     *
     * @ORM\Column(name="product_lock", type="string", length=0, nullable=false)
     */
    private $productLock;

    /**
     * @var string
     *
     * @ORM\Column(name="productshare", type="string", length=0, nullable=false, options={"default"="private","comment"="public = all user each merchant , private = each user in merchant , global = all user in every merchant (Assign Autherize for sale)"})
     */
    private $productshare = 'private';

    /**
     * @var string|null
     *
     * @ORM\Column(name="producttag", type="string", length=1500, nullable=true)
     */
    private $producttag;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productbrand", type="string", length=100, nullable=true)
     */
    private $productbrand;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productmodel", type="string", length=150, nullable=true)
     */
    private $productmodel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productsize", type="string", length=0, nullable=true, options={"default"="2","comment"="1 small 2 normal 3 large 4 extra"})
     */
    private $productsize = '2';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="productadddate", type="datetime", nullable=true)
     */
    private $productadddate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="productlastupdate", type="datetime", nullable=true)
     */
    private $productlastupdate;

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

    public function getExtProductcode(): ?string
    {
        return $this->extProductcode;
    }

    public function setExtProductcode(string $extProductcode): self
    {
        $this->extProductcode = $extProductcode;

        return $this;
    }

    public function getProductGlobalId(): ?int
    {
        return $this->productGlobalId;
    }

    public function setProductGlobalId(int $productGlobalId): self
    {
        $this->productGlobalId = $productGlobalId;

        return $this;
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

    public function getCreateby(): ?int
    {
        return $this->createby;
    }

    public function setCreateby(?int $createby): self
    {
        $this->createby = $createby;

        return $this;
    }

    public function getProductname(): ?string
    {
        return $this->productname;
    }

    public function setProductname(?string $productname): self
    {
        $this->productname = $productname;

        return $this;
    }

    public function getProductdetail(): ?string
    {
        return $this->productdetail;
    }

    public function setProductdetail(?string $productdetail): self
    {
        $this->productdetail = $productdetail;

        return $this;
    }

    public function getProductprice(): ?string
    {
        return $this->productprice;
    }

    public function setProductprice(?string $productprice): self
    {
        $this->productprice = $productprice;

        return $this;
    }

    public function getProductstatus(): ?string
    {
        return $this->productstatus;
    }

    public function setProductstatus(string $productstatus): self
    {
        $this->productstatus = $productstatus;

        return $this;
    }

    public function getProductLock(): ?string
    {
        return $this->productLock;
    }

    public function setProductLock(string $productLock): self
    {
        $this->productLock = $productLock;

        return $this;
    }

    public function getProductshare(): ?string
    {
        return $this->productshare;
    }

    public function setProductshare(string $productshare): self
    {
        $this->productshare = $productshare;

        return $this;
    }

    public function getProducttag(): ?string
    {
        return $this->producttag;
    }

    public function setProducttag(?string $producttag): self
    {
        $this->producttag = $producttag;

        return $this;
    }

    public function getProductbrand(): ?string
    {
        return $this->productbrand;
    }

    public function setProductbrand(?string $productbrand): self
    {
        $this->productbrand = $productbrand;

        return $this;
    }

    public function getProductmodel(): ?string
    {
        return $this->productmodel;
    }

    public function setProductmodel(?string $productmodel): self
    {
        $this->productmodel = $productmodel;

        return $this;
    }

    public function getProductsize(): ?string
    {
        return $this->productsize;
    }

    public function setProductsize(?string $productsize): self
    {
        $this->productsize = $productsize;

        return $this;
    }

    public function getProductadddate(): ?\DateTimeInterface
    {
        return $this->productadddate;
    }

    public function setProductadddate(?\DateTimeInterface $productadddate): self
    {
        $this->productadddate = $productadddate;

        return $this;
    }

    public function getProductlastupdate(): ?\DateTimeInterface
    {
        return $this->productlastupdate;
    }

    public function setProductlastupdate(?\DateTimeInterface $productlastupdate): self
    {
        $this->productlastupdate = $productlastupdate;

        return $this;
    }


}
