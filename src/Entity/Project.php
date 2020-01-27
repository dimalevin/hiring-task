<?php

namespace App\Entity;

use App\Enum\ProjectStatus;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\Range(min=1, max=3)
     */
    private $status = ProjectStatus::STATUS_PLANNED;

    /**
     * @ORM\Column(type="string", length=256)
     * @Assert\NotBlank(message = "Please fill in name of the project.")
     */
    private $name;

    /**
     * @ORM\Column(type="smallint")
     */
    private $totalEmployees = 0;

    /**
     * @ManyToMany(targetEntity="Employee", inversedBy="projects")
     * @JoinTable(name="employees_projects")
     */
    private $employees;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function getTotalEmployees(): int
    {
        return $this->totalEmployees;
    }

    public function setTotalEmployees(int $totalEmployees): void
    {
        $this->totalEmployees = $totalEmployees;
    }

    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function setEmployees(ArrayCollection $employees): void
    {
        $this->employees = $employees;
    }

    public function addEmployee(Employee $employee): void
    {
        if (!$this->employees->contains($employee)) {
            $this->employees->add($employee);
            $employee->addProject($this);
        }
    }

    public function removeEmployee(Employee $employee): void
    {
        if ($this->employees->contains($employee)) {
            $this->employees->removeElement($employee);
            $employee->removeProject($this);
        }
    }
}
