<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test01
 *
 * @ORM\Table(name="test01")
 * @ORM\Entity
 */
class Test01
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
     * @ORM\Column(name="testname", type="string", length=50, nullable=false)
     */
    private $testname;

    /**
     * @var int
     *
     * @ORM\Column(name="testval", type="integer", nullable=false)
     */
    private $testval;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTestname(): ?string
    {
        return $this->testname;
    }

    public function setTestname(string $testname): self
    {
        $this->testname = $testname;

        return $this;
    }

    public function getTestval(): ?int
    {
        return $this->testval;
    }

    public function setTestval(int $testval): self
    {
        $this->testval = $testval;

        return $this;
    }


}
