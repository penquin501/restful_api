<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalApikey
 *
 * @ORM\Table(name="global_apikey")
 * @ORM\Entity
 */
class GlobalApikey
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
     * @ORM\Column(name="apikey", type="string", length=500, nullable=false)
     */
    private $apikey;

    /**
     * @var string
     *
     * @ORM\Column(name="merid", type="string", length=10000, nullable=false)
     */
    private $merid;

    /**
     * @var string
     *
     * @ORM\Column(name="merauthenlevel", type="string", length=0, nullable=false, options={"default"="user"})
     */
    private $merauthenlevel = 'user';

    /**
     * @var string
     *
     * @ORM\Column(name="allow", type="string", length=2000, nullable=false)
     */
    private $allow;

    /**
     * @var string
     *
     * @ORM\Column(name="denial", type="string", length=2000, nullable=false)
     */
    private $denial;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=0, nullable=false, options={"default"="disactive"})
     */
    private $status = 'disactive';

    /**
     * @var string|null
     *
     * @ORM\Column(name="remark", type="string", length=500, nullable=true)
     */
    private $remark;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMerid(): ?string
    {
        return $this->merid;
    }

    public function setMerid(string $merid): self
    {
        $this->merid = $merid;

        return $this;
    }

    public function getMerauthenlevel(): ?string
    {
        return $this->merauthenlevel;
    }

    public function setMerauthenlevel(string $merauthenlevel): self
    {
        $this->merauthenlevel = $merauthenlevel;

        return $this;
    }

    public function getAllow(): ?string
    {
        return $this->allow;
    }

    public function setAllow(string $allow): self
    {
        $this->allow = $allow;

        return $this;
    }

    public function getDenial(): ?string
    {
        return $this->denial;
    }

    public function setDenial(string $denial): self
    {
        $this->denial = $denial;

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

    public function getRemark(): ?string
    {
        return $this->remark;
    }

    public function setRemark(?string $remark): self
    {
        $this->remark = $remark;

        return $this;
    }


}
