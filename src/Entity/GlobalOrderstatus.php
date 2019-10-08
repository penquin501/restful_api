<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalOrderstatus
 *
 * @ORM\Table(name="global_orderstatus", indexes={@ORM\Index(name="statuscode", columns={"statuscode"})})
 * @ORM\Entity
 */
class GlobalOrderstatus
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
     * @ORM\Column(name="statuscode", type="string", length=4, nullable=false)
     */
    private $statuscode;

    /**
     * @var string
     *
     * @ORM\Column(name="statusname_en", type="string", length=50, nullable=false)
     */
    private $statusnameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="statusname_th", type="string", length=50, nullable=false)
     */
    private $statusnameTh;

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

    public function getStatuscode(): ?string
    {
        return $this->statuscode;
    }

    public function setStatuscode(string $statuscode): self
    {
        $this->statuscode = $statuscode;

        return $this;
    }

    public function getStatusnameEn(): ?string
    {
        return $this->statusnameEn;
    }

    public function setStatusnameEn(string $statusnameEn): self
    {
        $this->statusnameEn = $statusnameEn;

        return $this;
    }

    public function getStatusnameTh(): ?string
    {
        return $this->statusnameTh;
    }

    public function setStatusnameTh(string $statusnameTh): self
    {
        $this->statusnameTh = $statusnameTh;

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
