<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalPromotionRaise
 *
 * @ORM\Table(name="global_promotion_raise")
 * @ORM\Entity
 */
class GlobalPromotionRaise
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
     * @var string
     *
     * @ORM\Column(name="merchant_directives", type="string", length=0, nullable=false, options={"default"="denied"})
     */
    private $merchantDirectives = 'denied';

    /**
     * @var string
     *
     * @ORM\Column(name="merchants_action_id", type="string", length=4100, nullable=false, options={"default"="[]"})
     */
    private $merchantsActionId = '[]';

    /**
     * @var string
     *
     * @ORM\Column(name="promotion_set", type="string", length=16100, nullable=false, options={"default"="[]"})
     */
    private $promotionSet = '[]';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_start", type="datetime", nullable=true)
     */
    private $dateStart;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_finish", type="datetime", nullable=true)
     */
    private $dateFinish;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_modify", type="datetime", nullable=true)
     */
    private $dateModify;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_create", type="datetime", nullable=true)
     */
    private $dateCreate;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getMerchantDirectives(): ?string
    {
        return $this->merchantDirectives;
    }

    public function setMerchantDirectives(string $merchantDirectives): self
    {
        $this->merchantDirectives = $merchantDirectives;

        return $this;
    }

    public function getMerchantsActionId(): ?string
    {
        return $this->merchantsActionId;
    }

    public function setMerchantsActionId(string $merchantsActionId): self
    {
        $this->merchantsActionId = $merchantsActionId;

        return $this;
    }

    public function getPromotionSet(): ?string
    {
        return $this->promotionSet;
    }

    public function setPromotionSet(string $promotionSet): self
    {
        $this->promotionSet = $promotionSet;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(?\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateFinish(): ?\DateTimeInterface
    {
        return $this->dateFinish;
    }

    public function setDateFinish(?\DateTimeInterface $dateFinish): self
    {
        $this->dateFinish = $dateFinish;

        return $this;
    }

    public function getDateModify(): ?\DateTimeInterface
    {
        return $this->dateModify;
    }

    public function setDateModify(?\DateTimeInterface $dateModify): self
    {
        $this->dateModify = $dateModify;

        return $this;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    public function setDateCreate(?\DateTimeInterface $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }


}
