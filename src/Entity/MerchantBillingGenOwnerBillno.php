<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MerchantBillingGenOwnerBillno
 *
 * @ORM\Table(name="merchant_billing_gen_owner_billno", indexes={@ORM\Index(name="takeorderby_geninvoice_idx", columns={"geninvoice"})})
 * @ORM\Entity
 */
class MerchantBillingGenOwnerBillno
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="datestamp", type="datetime", nullable=true)
     */
    private $datestamp;

    /**
     * @var int|null
     *
     * @ORM\Column(name="geninvoice", type="bigint", nullable=true)
     */
    private $geninvoice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatestamp(): ?\DateTimeInterface
    {
        return $this->datestamp;
    }

    public function setDatestamp(?\DateTimeInterface $datestamp): self
    {
        $this->datestamp = $datestamp;

        return $this;
    }

    public function getGeninvoice(): ?string
    {
        return $this->geninvoice;
    }

    public function setGeninvoice(?string $geninvoice): self
    {
        $this->geninvoice = $geninvoice;

        return $this;
    }


}
