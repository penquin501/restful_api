<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalBankIssue
 *
 * @ORM\Table(name="global_bank_issue")
 * @ORM\Entity
 */
class GlobalBankIssue
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
     * @ORM\Column(name="bank_th", type="string", length=100, nullable=true)
     */
    private $bankTh;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bank_en", type="string", length=100, nullable=true)
     */
    private $bankEn;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=0, nullable=false, options={"default"="active"})
     */
    private $status = 'active';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBankTh(): ?string
    {
        return $this->bankTh;
    }

    public function setBankTh(?string $bankTh): self
    {
        $this->bankTh = $bankTh;

        return $this;
    }

    public function getBankEn(): ?string
    {
        return $this->bankEn;
    }

    public function setBankEn(?string $bankEn): self
    {
        $this->bankEn = $bankEn;

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
