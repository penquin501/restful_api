<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdminFfmAuthen
 *
 * @ORM\Table(name="admin_ffm_authen", indexes={@ORM\Index(name="uname_pwrd", columns={"uname", "pwrd"}), @ORM\Index(name="uname", columns={"uname"})})
 * @ORM\Entity
 */
class AdminFfmAuthen
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
     * @var string
     *
     * @ORM\Column(name="authenlevel", type="string", length=0, nullable=false, options={"default"="user"})
     */
    private $authenlevel = 'user';

    /**
     * @var string|null
     *
     * @ORM\Column(name="permission", type="string", length=15000, nullable=true)
     */
    private $permission;

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
