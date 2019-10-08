<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalTransportprice
 *
 * @ORM\Table(name="global_transportprice")
 * @ORM\Entity
 */
class GlobalTransportprice
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
     * @ORM\Column(name="transportname_en", type="string", length=50, nullable=false)
     */
    private $transportnameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="transportname_th", type="string", length=50, nullable=false)
     */
    private $transportnameTh;

    /**
     * @var string
     *
     * @ORM\Column(name="transportvalue", type="string", length=15, nullable=false)
     */
    private $transportvalue;

    /**
     * @var string
     *
     * @ORM\Column(name="transportprice", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $transportprice;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $active = '1';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransportnameEn(): ?string
    {
        return $this->transportnameEn;
    }

    public function setTransportnameEn(string $transportnameEn): self
    {
        $this->transportnameEn = $transportnameEn;

        return $this;
    }

    public function getTransportnameTh(): ?string
    {
        return $this->transportnameTh;
    }

    public function setTransportnameTh(string $transportnameTh): self
    {
        $this->transportnameTh = $transportnameTh;

        return $this;
    }

    public function getTransportvalue(): ?string
    {
        return $this->transportvalue;
    }

    public function setTransportvalue(string $transportvalue): self
    {
        $this->transportvalue = $transportvalue;

        return $this;
    }

    public function getTransportprice(): ?string
    {
        return $this->transportprice;
    }

    public function setTransportprice(string $transportprice): self
    {
        $this->transportprice = $transportprice;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }


}
