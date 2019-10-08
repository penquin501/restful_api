<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParcelMember
 *
 * @ORM\Table(name="parcel_member", uniqueConstraints={@ORM\UniqueConstraint(name="member_id_unx", columns={"member_id"})}, indexes={@ORM\Index(name="member_id", columns={"member_id"}), @ORM\Index(name="phoneregis", columns={"phoneregis"})})
 * @ORM\Entity
 */
class ParcelMember
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
     * @ORM\Column(name="member_id", type="string", length=20, nullable=false, options={"comment"="merid + max member id count on mer + y + m +d + ((merid + max member id count on mer + y + m +d)(เอาตัวท้าย))"})
     */
    private $memberId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="merid", type="integer", nullable=true)
     */
    private $merid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="citizenid", type="string", length=13, nullable=true)
     */
    private $citizenid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="firstname", type="string", length=100, nullable=true)
     */
    private $firstname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lastname", type="string", length=100, nullable=true)
     */
    private $lastname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="aliasname", type="string", length=100, nullable=true)
     */
    private $aliasname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ref_address", type="string", length=200, nullable=true)
     */
    private $refAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phoneregis", type="string", length=15, nullable=true)
     */
    private $phoneregis;

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=true)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="passcode", type="string", length=50, nullable=true)
     */
    private $passcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bankacc", type="string", length=20, nullable=true)
     */
    private $bankacc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bank_issue", type="string", length=100, nullable=true)
     */
    private $bankIssue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bank_acc_name", type="string", length=200, nullable=true)
     */
    private $bankAccName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bank_info_proven", type="string", length=0, nullable=true, options={"default"="notpass"})
     */
    private $bankInfoProven = 'notpass';

    /**
     * @var string|null
     *
     * @ORM\Column(name="prefixcode", type="string", length=3, nullable=true)
     */
    private $prefixcode;

    /**
     * @var int
     *
     * @ORM\Column(name="member_transfer_fee", type="integer", nullable=false, options={"default"="20"})
     */
    private $memberTransferFee = '20';

    /**
     * @var string
     *
     * @ORM\Column(name="peak_value", type="string", length=100, nullable=false)
     */
    private $peakValue;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=0, nullable=false, options={"default"="inactive"})
     */
    private $status = 'inactive';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMemberId(): ?string
    {
        return $this->memberId;
    }

    public function setMemberId(string $memberId): self
    {
        $this->memberId = $memberId;

        return $this;
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

    public function getCitizenid(): ?string
    {
        return $this->citizenid;
    }

    public function setCitizenid(?string $citizenid): self
    {
        $this->citizenid = $citizenid;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAliasname(): ?string
    {
        return $this->aliasname;
    }

    public function setAliasname(?string $aliasname): self
    {
        $this->aliasname = $aliasname;

        return $this;
    }

    public function getRefAddress(): ?string
    {
        return $this->refAddress;
    }

    public function setRefAddress(?string $refAddress): self
    {
        $this->refAddress = $refAddress;

        return $this;
    }

    public function getPhoneregis(): ?string
    {
        return $this->phoneregis;
    }

    public function setPhoneregis(?string $phoneregis): self
    {
        $this->phoneregis = $phoneregis;

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

    public function getPasscode(): ?string
    {
        return $this->passcode;
    }

    public function setPasscode(?string $passcode): self
    {
        $this->passcode = $passcode;

        return $this;
    }

    public function getBankacc(): ?string
    {
        return $this->bankacc;
    }

    public function setBankacc(?string $bankacc): self
    {
        $this->bankacc = $bankacc;

        return $this;
    }

    public function getBankIssue(): ?string
    {
        return $this->bankIssue;
    }

    public function setBankIssue(?string $bankIssue): self
    {
        $this->bankIssue = $bankIssue;

        return $this;
    }

    public function getBankAccName(): ?string
    {
        return $this->bankAccName;
    }

    public function setBankAccName(?string $bankAccName): self
    {
        $this->bankAccName = $bankAccName;

        return $this;
    }

    public function getBankInfoProven(): ?string
    {
        return $this->bankInfoProven;
    }

    public function setBankInfoProven(?string $bankInfoProven): self
    {
        $this->bankInfoProven = $bankInfoProven;

        return $this;
    }

    public function getPrefixcode(): ?string
    {
        return $this->prefixcode;
    }

    public function setPrefixcode(?string $prefixcode): self
    {
        $this->prefixcode = $prefixcode;

        return $this;
    }

    public function getMemberTransferFee(): ?int
    {
        return $this->memberTransferFee;
    }

    public function setMemberTransferFee(int $memberTransferFee): self
    {
        $this->memberTransferFee = $memberTransferFee;

        return $this;
    }

    public function getPeakValue(): ?string
    {
        return $this->peakValue;
    }

    public function setPeakValue(string $peakValue): self
    {
        $this->peakValue = $peakValue;

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
