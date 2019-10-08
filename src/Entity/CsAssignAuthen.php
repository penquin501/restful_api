<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CsAssignAuthen
 *
 * @ORM\Table(name="CS_ASSIGN_AUTHEN")
 * @ORM\Entity
 */
class CsAssignAuthen
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
     * @ORM\Column(name="username", type="string", length=100, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="fullname", type="string", length=100, nullable=false)
     */
    private $fullname;

    /**
     * @var string
     *
     * @ORM\Column(name="userlevel", type="string", length=0, nullable=false, options={"default"="viewer"})
     */
    private $userlevel = 'viewer';

    /**
     * @var string
     *
     * @ORM\Column(name="user_status", type="string", length=0, nullable=false, options={"default"="active"})
     */
    private $userStatus = 'active';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getUserlevel(): ?string
    {
        return $this->userlevel;
    }

    public function setUserlevel(string $userlevel): self
    {
        $this->userlevel = $userlevel;

        return $this;
    }

    public function getUserStatus(): ?string
    {
        return $this->userStatus;
    }

    public function setUserStatus(string $userStatus): self
    {
        $this->userStatus = $userStatus;

        return $this;
    }


}
