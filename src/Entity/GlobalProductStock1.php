<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalProductStock1
 *
 * @ORM\Table(name="global_product_stock1")
 * @ORM\Entity
 */
class GlobalProductStock1
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
     * @ORM\Column(name="operateby", type="integer", nullable=false)
     */
    private $operateby;

    /**
     * @var int
     *
     * @ORM\Column(name="productid", type="integer", nullable=false)
     */
    private $productid;

    /**
     * @var int
     *
     * @ORM\Column(name="productin", type="integer", nullable=false)
     */
    private $productin = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="timeprodin", type="datetime", nullable=true)
     */
    private $timeprodin;

    /**
     * @var int
     *
     * @ORM\Column(name="productout", type="integer", nullable=false)
     */
    private $productout = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="timeprodout", type="datetime", nullable=true)
     */
    private $timeprodout;

    /**
     * @var string
     *
     * @ORM\Column(name="prodremark", type="string", length=100, nullable=false)
     */
    private $prodremark;

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

    public function getOperateby(): ?int
    {
        return $this->operateby;
    }

    public function setOperateby(int $operateby): self
    {
        $this->operateby = $operateby;

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

    public function getProductin(): ?int
    {
        return $this->productin;
    }

    public function setProductin(int $productin): self
    {
        $this->productin = $productin;

        return $this;
    }

    public function getTimeprodin(): ?\DateTimeInterface
    {
        return $this->timeprodin;
    }

    public function setTimeprodin(?\DateTimeInterface $timeprodin): self
    {
        $this->timeprodin = $timeprodin;

        return $this;
    }

    public function getProductout(): ?int
    {
        return $this->productout;
    }

    public function setProductout(int $productout): self
    {
        $this->productout = $productout;

        return $this;
    }

    public function getTimeprodout(): ?\DateTimeInterface
    {
        return $this->timeprodout;
    }

    public function setTimeprodout(?\DateTimeInterface $timeprodout): self
    {
        $this->timeprodout = $timeprodout;

        return $this;
    }

    public function getProdremark(): ?string
    {
        return $this->prodremark;
    }

    public function setProdremark(string $prodremark): self
    {
        $this->prodremark = $prodremark;

        return $this;
    }


}
