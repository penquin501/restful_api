<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParcelNicename
 *
 * @ORM\Table(name="parcel_nicename")
 * @ORM\Entity
 */
class ParcelNicename
{
    /**
     * @var int
     *
     * @ORM\Column(name="pkey", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pkey;

    /**
     * @var int
     *
     * @ORM\Column(name="p_gid", type="integer", nullable=false)
     */
    private $pGid;

    /**
     * @var string
     *
     * @ORM\Column(name="p_name", type="string", length=100, nullable=false)
     */
    private $pName;

    /**
     * @var string
     *
     * @ORM\Column(name="p_nick", type="string", length=100, nullable=false)
     */
    private $pNick;

    public function getPkey(): ?int
    {
        return $this->pkey;
    }

    public function getPGid(): ?int
    {
        return $this->pGid;
    }

    public function setPGid(int $pGid): self
    {
        $this->pGid = $pGid;

        return $this;
    }

    public function getPName(): ?string
    {
        return $this->pName;
    }

    public function setPName(string $pName): self
    {
        $this->pName = $pName;

        return $this;
    }

    public function getPNick(): ?string
    {
        return $this->pNick;
    }

    public function setPNick(string $pNick): self
    {
        $this->pNick = $pNick;

        return $this;
    }


}
