<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogMerchantSmsSend
 *
 * @ORM\Table(name="log_merchant_sms_send")
 * @ORM\Entity
 */
class LogMerchantSmsSend
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
     * @var string|null
     *
     * @ORM\Column(name="ipaddr", type="string", length=20, nullable=true)
     */
    private $ipaddr;

    /**
     * @var string
     *
     * @ORM\Column(name="apikey", type="string", length=255, nullable=false)
     */
    private $apikey;

    /**
     * @var int
     *
     * @ORM\Column(name="takeorderby", type="integer", nullable=false)
     */
    private $takeorderby;

    /**
     * @var string
     *
     * @ORM\Column(name="sms_message", type="string", length=500, nullable=false)
     */
    private $smsMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="dest_phoneno", type="string", length=15, nullable=false)
     */
    private $destPhoneno;

    /**
     * @var string
     *
     * @ORM\Column(name="smsid", type="string", length=100, nullable=false)
     */
    private $smsid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="logtimestamp", type="datetime", nullable=false)
     */
    private $logtimestamp;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getIpaddr(): ?string
    {
        return $this->ipaddr;
    }

    public function setIpaddr(?string $ipaddr): self
    {
        $this->ipaddr = $ipaddr;

        return $this;
    }

    public function getApikey(): ?string
    {
        return $this->apikey;
    }

    public function setApikey(string $apikey): self
    {
        $this->apikey = $apikey;

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

    public function getSmsMessage(): ?string
    {
        return $this->smsMessage;
    }

    public function setSmsMessage(string $smsMessage): self
    {
        $this->smsMessage = $smsMessage;

        return $this;
    }

    public function getDestPhoneno(): ?string
    {
        return $this->destPhoneno;
    }

    public function setDestPhoneno(string $destPhoneno): self
    {
        $this->destPhoneno = $destPhoneno;

        return $this;
    }

    public function getSmsid(): ?string
    {
        return $this->smsid;
    }

    public function setSmsid(string $smsid): self
    {
        $this->smsid = $smsid;

        return $this;
    }

    public function getLogtimestamp(): ?\DateTimeInterface
    {
        return $this->logtimestamp;
    }

    public function setLogtimestamp(\DateTimeInterface $logtimestamp): self
    {
        $this->logtimestamp = $logtimestamp;

        return $this;
    }


}
