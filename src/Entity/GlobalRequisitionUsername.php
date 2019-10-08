<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalRequisitionUsername
 *
 * @ORM\Table(name="global_requisition_username")
 * @ORM\Entity
 */
class GlobalRequisitionUsername
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
     * @var int|null
     *
     * @ORM\Column(name="merid", type="integer", nullable=true)
     */
    private $merid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=true)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fullname", type="string", length=200, nullable=true)
     */
    private $fullname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mobilephone", type="string", length=15, nullable=true)
     */
    private $mobilephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="idcard", type="string", length=13, nullable=true)
     */
    private $idcard;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=0, nullable=false, options={"default"="new"})
     */
    private $status = 'new';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMerid(): ?int
    {
        return $this->merid;
    }

    public function setMerid(?int $merid): self
    {
        $this->merid = $merid;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(?string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getMobilephone(): ?string
    {
        return $this->mobilephone;
    }

    public function setMobilephone(?string $mobilephone): self
    {
        $this->mobilephone = $mobilephone;

        return $this;
    }

    public function getIdcard(): ?string
    {
        return $this->idcard;
    }

    public function setIdcard(?string $idcard): self
    {
        $this->idcard = $idcard;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }


}
