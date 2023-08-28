<?php

namespace App\Entity;

use App\Repository\FilierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FilierRepository::class)]
class Filier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Regex(
      pattern: '/^[A-Za-z0-9À-ÿ\s]+$/u',
      message: 'The name should only contain alphabetic characters, numbers, and spaces.'
    )]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'filier', targetEntity: Module::class, cascade: ['remove']) ]
    private Collection $modules;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Module>
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): static
    {
        if (!$this->modules->contains($module)) {
            $this->modules->add($module);
            $module->setFilier($this);
        }

        return $this;
    }

    public function removeModule(Module $module): static
    {
        if ($this->modules->removeElement($module)) {
            // set the owning side to null (unless already changed)
            if ($module->getFilier() === $this) {
                $module->setFilier(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
