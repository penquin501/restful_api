<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity
 */
class Test
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
     * @ORM\Column(name="t1", type="string", length=1000, nullable=false)
     */
    private $t1;

    /**
     * @var int
     *
     * @ORM\Column(name="t2", type="bigint", nullable=false)
     */
    private $t2;

    /**
     * @var int
     *
     * @ORM\Column(name="t3", type="bigint", nullable=false)
     */
    private $t3;

    /**
     * @var int
     *
     * @ORM\Column(name="t4", type="bigint", nullable=false)
     */
    private $t4;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getT1(): ?string
    {
        return $this->t1;
    }

    public function setT1(string $t1): self
    {
        $this->t1 = $t1;

        return $this;
    }

    public function getT2(): ?string
    {
        return $this->t2;
    }

    public function setT2(string $t2): self
    {
        $this->t2 = $t2;

        return $this;
    }

    public function getT3(): ?string
    {
        return $this->t3;
    }

    public function setT3(string $t3): self
    {
        $this->t3 = $t3;

        return $this;
    }

    public function getT4(): ?string
    {
        return $this->t4;
    }

    public function setT4(string $t4): self
    {
        $this->t4 = $t4;

        return $this;
    }


}
