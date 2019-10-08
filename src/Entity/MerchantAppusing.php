<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MerchantAppusing
 *
 * @ORM\Table(name="merchant_appusing")
 * @ORM\Entity
 */
class MerchantAppusing
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
     * @ORM\Column(name="takeorderby", type="integer", nullable=false)
     */
    private $takeorderby;

    /**
     * @var string|null
     *
     * @ORM\Column(name="APPUSED", type="string", length=30, nullable=true, options={"fixed"=true})
     */
    private $appused;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DEVICENAME", type="string", length=255, nullable=true, options={"fixed"=true})
     */
    private $devicename;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DEVICEID", type="string", length=255, nullable=true, options={"fixed"=true})
     */
    private $deviceid;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DATE", type="datetime", nullable=true)
     */
    private $date;

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

    public function getAppused(): ?string
    {
        return $this->appused;
    }

    public function setAppused(?string $appused): self
    {
        $this->appused = $appused;

        return $this;
    }

    public function getDevicename(): ?string
    {
        return $this->devicename;
    }

    public function setDevicename(?string $devicename): self
    {
        $this->devicename = $devicename;

        return $this;
    }

    public function getDeviceid(): ?string
    {
        return $this->deviceid;
    }

    public function setDeviceid(?string $deviceid): self
    {
        $this->deviceid = $deviceid;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }


}
