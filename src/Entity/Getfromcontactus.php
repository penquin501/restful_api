<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Getfromcontactus
 *
 * @ORM\Table(name="getfromcontactus")
 * @ORM\Entity
 */
class Getfromcontactus
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
     * @var string|null
     *
     * @ORM\Column(name="contactname", type="string", length=500, nullable=true)
     */
    private $contactname;

    /**
     * @var string
     *
     * @ORM\Column(name="idcard", type="string", length=13, nullable=false)
     */
    private $idcard;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contacteaddr", type="string", length=300, nullable=true)
     */
    private $contacteaddr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contactezipcode", type="string", length=5, nullable=true)
     */
    private $contactezipcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contactphone", type="string", length=20, nullable=true)
     */
    private $contactphone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contactmsg", type="string", length=5000, nullable=true)
     */
    private $contactmsg;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="contacttime", type="datetime", nullable=true)
     */
    private $contacttime;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=0, nullable=false, options={"default"="new"})
     */
    private $status = 'new';

    /**
     * @var string|null
     *
     * @ORM\Column(name="refcode", type="string", length=128, nullable=true)
     */
    private $refcode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContactname(): ?string
    {
        return $this->contactname;
    }

    public function setContactname(?string $contactname): self
    {
        $this->contactname = $contactname;

        return $this;
    }

    public function getIdcard(): ?string
    {
        return $this->idcard;
    }

    public function setIdcard(string $idcard): self
    {
        $this->idcard = $idcard;

        return $this;
    }

    public function getContacteaddr(): ?string
    {
        return $this->contacteaddr;
    }

    public function setContacteaddr(?string $contacteaddr): self
    {
        $this->contacteaddr = $contacteaddr;

        return $this;
    }

    public function getContactezipcode(): ?string
    {
        return $this->contactezipcode;
    }

    public function setContactezipcode(?string $contactezipcode): self
    {
        $this->contactezipcode = $contactezipcode;

        return $this;
    }

    public function getContactphone(): ?string
    {
        return $this->contactphone;
    }

    public function setContactphone(?string $contactphone): self
    {
        $this->contactphone = $contactphone;

        return $this;
    }

    public function getContactmsg(): ?string
    {
        return $this->contactmsg;
    }

    public function setContactmsg(?string $contactmsg): self
    {
        $this->contactmsg = $contactmsg;

        return $this;
    }

    public function getContacttime(): ?\DateTimeInterface
    {
        return $this->contacttime;
    }

    public function setContacttime(?\DateTimeInterface $contacttime): self
    {
        $this->contacttime = $contacttime;

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

    public function getRefcode(): ?string
    {
        return $this->refcode;
    }

    public function setRefcode(?string $refcode): self
    {
        $this->refcode = $refcode;

        return $this;
    }


}
