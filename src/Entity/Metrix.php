<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MetrixRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetrixRepository::class)]
#[ApiResource]
class Metrix
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $metrixSystem;

    #[ORM\OneToMany(mappedBy: 'metrix', targetEntity: Achievement::class)]
    private $achievements;

    #[ORM\ManyToMany(targetEntity: UserMetrix::class, mappedBy: 'metrix')]
    private $userMetrixes;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'metrixes')]
    private $category;


    public function __construct()
    {
        $this->achievements = new ArrayCollection();
        $this->userMetrixes = new ArrayCollection();
        $this->category = new ArrayCollection();
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

    public function getMetrixSystem(): ?string
    {
        return $this->metrixSystem;
    }

    public function setMetrixSystem(string $metrixSystem): self
    {
        $this->metrixSystem = $metrixSystem;

        return $this;
    }

    /**
     * @return Collection|Achievement[]
     */
    public function getAchievements(): Collection
    {
        return $this->achievements;
    }

    public function addAchievement(Achievement $achievement): self
    {
        if (!$this->achievements->contains($achievement)) {
            $this->achievements[] = $achievement;
            $achievement->setMetrix($this);
        }

        return $this;
    }

    public function removeAchievement(Achievement $achievement): self
    {
        if ($this->achievements->removeElement($achievement)) {
            // set the owning side to null (unless already changed)
            if ($achievement->getMetrix() === $this) {
                $achievement->setMetrix(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserMetrix[]
     */
    public function getUserMetrixes(): Collection
    {
        return $this->userMetrixes;
    }

    public function addUserMetrix(UserMetrix $userMetrix): self
    {
        if (!$this->userMetrixes->contains($userMetrix)) {
            $this->userMetrixes[] = $userMetrix;
            $userMetrix->addMetrix($this);
        }

        return $this;
    }

    public function removeUserMetrix(UserMetrix $userMetrix): self
    {
        if ($this->userMetrixes->removeElement($userMetrix)) {
            $userMetrix->removeMetrix($this);
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }


}
