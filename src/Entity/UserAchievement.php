<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserAchievementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserAchievementRepository::class)]
#[ApiResource]
class UserAchievement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'achievement')]
    private $user;

    #[ORM\ManyToMany(targetEntity: Achievement::class, inversedBy: 'user')]
    private $achievement;

    #[ORM\Column(type: 'datetime_immutable')]
    private $obtainedDate;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->achievement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }

    /**
     * @return Collection|Achievement[]
     */
    public function getAchievement(): Collection
    {
        return $this->achievement;
    }

    public function addAchievement(Achievement $achievement): self
    {
        if (!$this->achievement->contains($achievement)) {
            $this->achievement[] = $achievement;
        }

        return $this;
    }

    public function removeAchievement(Achievement $achievement): self
    {
        $this->achievement->removeElement($achievement);

        return $this;
    }

    public function getObtainedDate(): ?\DateTimeImmutable
    {
        return $this->obtainedDate;
    }

    public function setObtainedDate(\DateTimeImmutable $obtainedDate): self
    {
        $this->obtainedDate = $obtainedDate;

        return $this;
    }
}
