<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyProject
 *
 * @ORM\Table(name="company_project", indexes={@ORM\Index(name="project_code", columns={"project_code"})})
 * @ORM\Entity
 */
class CompanyProject
{
    /**
     * @var int
     *
     * @ORM\Column(name="project_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $projectId;

    /**
     * @var int
     *
     * @ORM\Column(name="project_code", type="integer", nullable=false)
     */
    private $projectCode;

    /**
     * @var string
     *
     * @ORM\Column(name="project_name", type="string", length=50, nullable=false)
     */
    private $projectName;

    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    public function getProjectCode(): ?int
    {
        return $this->projectCode;
    }

    public function setProjectCode(int $projectCode): self
    {
        $this->projectCode = $projectCode;

        return $this;
    }

    public function getProjectName(): ?string
    {
        return $this->projectName;
    }

    public function setProjectName(string $projectName): self
    {
        $this->projectName = $projectName;

        return $this;
    }


}
