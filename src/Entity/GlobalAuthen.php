<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalAuthen
 *
 * @ORM\Table(name="global_authen", indexes={@ORM\Index(name="phoneno", columns={"phoneno"}), @ORM\Index(name="uname", columns={"uname"}), @ORM\Index(name="id", columns={"id"}), @ORM\Index(name="uname_pwrd", columns={"uname", "pwrd"}), @ORM\Index(name="merid_idx", columns={"merid"}), @ORM\Index(name="merid_uid", columns={"merid", "id"})})
 * @ORM\Entity
 */
class GlobalAuthen
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
     * @ORM\Column(name="afa_user", type="string", length=0, nullable=false, options={"default"="no"})
     */
    private $afaUser = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="afa_level", type="string", length=0, nullable=false, options={"default"="agent"})
     */
    private $afaLevel = 'agent';

    /**
     * @var string
     *
     * @ORM\Column(name="afa_rank", type="string", length=10, nullable=false)
     */
    private $afaRank;

    /**
     * @var int
     *
     * @ORM\Column(name="ref_user_id", type="integer", nullable=false)
     */
    private $refUserId = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="merid", type="integer", nullable=true)
     */
    private $merid;

    /**
     * @var string
     *
     * @ORM\Column(name="uname", type="string", length=50, nullable=false)
     */
    private $uname;

    /**
     * @var string
     *
     * @ORM\Column(name="pwrd", type="string", length=200, nullable=false)
     */
    private $pwrd;

    /**
     * @var string
     *
     * @ORM\Column(name="fname", type="string", length=200, nullable=false)
     */
    private $fname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phoneno", type="string", length=15, nullable=true)
     */
    private $phoneno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="idcard", type="string", length=20, nullable=true)
     */
    private $idcard;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="rolefunction", type="string", length=200, nullable=false, options={"default"="["seller"]"})
//     */
//    private $rolefunction = '["seller"]';

    /**
     * @var string
     *
     * @ORM\Column(name="authenlevel", type="string", length=0, nullable=false, options={"default"="user"})
     */
    private $authenlevel = 'user';

    /**
     * @var string|null
     *
     * @ORM\Column(name="permission", type="string", length=10000, nullable=true)
     */
    private $permission;

//    /**
//     * @var string|null
//     *
//     * @ORM\Column(name="autherize_other_mer", type="string", length=10000, nullable=true, options={"default"="{"merid":[],"permission":[]}"})
//     */
//    private $autherizeOtherMer = '{"merid":[],"permission":[]}';

    /**
     * @var string|null
     *
     * @ORM\Column(name="lang", type="string", length=0, nullable=true)
     */
    private $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=0, nullable=false)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAfaUser(): ?string
    {
        return $this->afaUser;
    }

    public function setAfaUser(string $afaUser): self
    {
        $this->afaUser = $afaUser;

        return $this;
    }

    public function getAfaLevel(): ?string
    {
        return $this->afaLevel;
    }

    public function setAfaLevel(string $afaLevel): self
    {
        $this->afaLevel = $afaLevel;

        return $this;
    }

    public function getAfaRank(): ?string
    {
        return $this->afaRank;
    }

    public function setAfaRank(string $afaRank): self
    {
        $this->afaRank = $afaRank;

        return $this;
    }

    public function getRefUserId(): ?int
    {
        return $this->refUserId;
    }

    public function setRefUserId(int $refUserId): self
    {
        $this->refUserId = $refUserId;

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

    public function getUname(): ?string
    {
        return $this->uname;
    }

    public function setUname(string $uname): self
    {
        $this->uname = $uname;

        return $this;
    }

    public function getPwrd(): ?string
    {
        return $this->pwrd;
    }

    public function setPwrd(string $pwrd): self
    {
        $this->pwrd = $pwrd;

        return $this;
    }

    public function getFname(): ?string
    {
        return $this->fname;
    }

    public function setFname(string $fname): self
    {
        $this->fname = $fname;

        return $this;
    }

    public function getPhoneno(): ?string
    {
        return $this->phoneno;
    }

    public function setPhoneno(?string $phoneno): self
    {
        $this->phoneno = $phoneno;

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

    public function getAuthenlevel(): ?string
    {
        return $this->authenlevel;
    }

    public function setAuthenlevel(string $authenlevel): self
    {
        $this->authenlevel = $authenlevel;

        return $this;
    }

    public function getPermission(): ?string
    {
        return $this->permission;
    }

    public function setPermission(?string $permission): self
    {
        $this->permission = $permission;

        return $this;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(?string $lang): self
    {
        $this->lang = $lang;

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
