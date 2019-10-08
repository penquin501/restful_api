<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalOtpCheck
 *
 * @ORM\Table(name="global_otp_check", indexes={@ORM\Index(name="phoneno_prefixcheck_idx", columns={"phoneno", "prefixcheck"})})
 * @ORM\Entity
 */
class GlobalOtpCheck
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
     * @var string
     *
     * @ORM\Column(name="prefixcheck", type="string", length=4, nullable=false)
     */
    private $prefixcheck;

    /**
     * @var string|null
     *
     * @ORM\Column(name="otpnumber", type="string", length=6, nullable=true)
     */
    private $otpnumber;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneno", type="string", length=11, nullable=false)
     */
    private $phoneno;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="createdate", type="datetime", nullable=true)
     */
    private $createdate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="authendate", type="datetime", nullable=true)
     */
    private $authendate;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="otpfailcount", type="boolean", nullable=true)
     */
    private $otpfailcount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="smsTransactionID", type="string", length=25, nullable=true)
     */
    private $smstransactionid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="requisitionby", type="string", length=200, nullable=true)
     */
    private $requisitionby;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=0, nullable=false, options={"default"="cancel"})
     */
    private $status = 'cancel';

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getPrefixcheck(): ?string
    {
        return $this->prefixcheck;
    }

    public function setPrefixcheck(string $prefixcheck): self
    {
        $this->prefixcheck = $prefixcheck;

        return $this;
    }

    public function getOtpnumber(): ?string
    {
        return $this->otpnumber;
    }

    public function setOtpnumber(?string $otpnumber): self
    {
        $this->otpnumber = $otpnumber;

        return $this;
    }

    public function getPhoneno(): ?string
    {
        return $this->phoneno;
    }

    public function setPhoneno(string $phoneno): self
    {
        $this->phoneno = $phoneno;

        return $this;
    }

    public function getCreatedate(): ?\DateTimeInterface
    {
        return $this->createdate;
    }

    public function setCreatedate(?\DateTimeInterface $createdate): self
    {
        $this->createdate = $createdate;

        return $this;
    }

    public function getAuthendate(): ?\DateTimeInterface
    {
        return $this->authendate;
    }

    public function setAuthendate(?\DateTimeInterface $authendate): self
    {
        $this->authendate = $authendate;

        return $this;
    }

    public function getOtpfailcount(): ?bool
    {
        return $this->otpfailcount;
    }

    public function setOtpfailcount(?bool $otpfailcount): self
    {
        $this->otpfailcount = $otpfailcount;

        return $this;
    }

    public function getSmstransactionid(): ?string
    {
        return $this->smstransactionid;
    }

    public function setSmstransactionid(?string $smstransactionid): self
    {
        $this->smstransactionid = $smstransactionid;

        return $this;
    }

    public function getRequisitionby(): ?string
    {
        return $this->requisitionby;
    }

    public function setRequisitionby(?string $requisitionby): self
    {
        $this->requisitionby = $requisitionby;

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
