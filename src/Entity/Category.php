<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\Column(type: 'boolean')]
    private $unable;

    #[ORM\Column(type: 'float')]
    private $objectiveValue;

    #[ORM\ManyToMany(targetEntity: UserCategory::class, mappedBy: 'category')]
    private $userCategories;

    #[ORM\ManyToMany(targetEntity: Metrix::class, mappedBy: 'category')]
    private $metrixes;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;


    public function __construct()
    {
        $this->userCategories = new ArrayCollection();
        $this->metrixes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getUnable(): ?bool
    {
        return $this->unable;
    }

    public function setUnable(bool $unable): self
    {
        $this->unable = $unable;

        return $this;
    }

    public function getObjectiveValue(): ?float
    {
        return $this->objectiveValue;
    }

    public function setObjectiveValue(float $objectiveValue): self
    {
        $this->objectiveValue = $objectiveValue;

        return $this;
    }

    /**
     * @return Collection|UserCategory[]
     */
    public function getUserCategories(): Collection
    {
        return $this->userCategories;
    }

    public function addUserCategory(UserCategory $userCategory): self
    {
        if (!$this->userCategories->contains($userCategory)) {
            $this->userCategories[] = $userCategory;
            $userCategory->addCategory($this);
        }

        return $this;
    }

    public function removeUserCategory(UserCategory $userCategory): self
    {
        if ($this->userCategories->removeElement($userCategory)) {
            $userCategory->removeCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection|Metrix[]
     */
    public function getMetrixes(): Collection
    {
        return $this->metrixes;
    }

    public function addMetrix(Metrix $metrix): self
    {
        if (!$this->metrixes->contains($metrix)) {
            $this->metrixes[] = $metrix;
            $metrix->addCategory($this);
        }

        return $this;
    }

    public function removeMetrix(Metrix $metrix): self
    {
        if ($this->metrixes->removeElement($metrix)) {
            $metrix->removeCategory($this);
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

}
