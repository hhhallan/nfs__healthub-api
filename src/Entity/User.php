<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $pseudo;

    #[ORM\Column(type: 'string', length: 255)]
    private $mail;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tokenResetPassword;

    #[ORM\Column(type: 'integer')]
    private $age;

    #[ORM\Column(type: 'boolean')]
    private $gender;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private $tokenResetPasswordExpiration;

    #[ORM\Column(type: 'datetime')]
    private $loginLastTime;

    #[ORM\ManyToMany(targetEntity: UserAchievement::class, mappedBy: 'user')]
    private $achievement;

    #[ORM\ManyToMany(targetEntity: UserMetrix::class, mappedBy: 'user')]
    private $userMetrixes;

    #[ORM\ManyToMany(targetEntity: UserCategory::class, mappedBy: 'user')]
    private $userCategories;

    public function __construct()
    {
        $this->achievement = new ArrayCollection();
        $this->userMetrixes = new ArrayCollection();
        $this->userCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

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

    public function getTokenResetPassword(): ?string
    {
        return $this->tokenResetPassword;
    }

    public function setTokenResetPassword(?string $tokenResetPassword): self
    {
        $this->tokenResetPassword = $tokenResetPassword;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getGender(): ?bool
    {
        return $this->gender;
    }

    public function setGender(bool $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTokenResetPasswordExpiration(): ?\DateTimeImmutable
    {
        return $this->tokenResetPasswordExpiration;
    }

    public function setTokenResetPasswordExpiration(\DateTimeImmutable $tokenResetPasswordExpiration): self
    {
        $this->tokenResetPasswordExpiration = $tokenResetPasswordExpiration;

        return $this;
    }

    public function getLoginLastTime(): ?\DateTimeInterface
    {
        return $this->loginLastTime;
    }

    public function setLoginLastTime(\DateTimeInterface $loginLastTime): self
    {
        $this->loginLastTime = $loginLastTime;

        return $this;
    }

    /**
     * @return Collection|UserAchievement[]
     */
    public function getAchievement(): Collection
    {
        return $this->achievement;
    }

    public function addAchievement(UserAchievement $achievement): self
    {
        if (!$this->achievement->contains($achievement)) {
            $this->achievement[] = $achievement;
            $achievement->addUser($this);
        }

        return $this;
    }

    public function removeAchievement(UserAchievement $achievement): self
    {
        if ($this->achievement->removeElement($achievement)) {
            $achievement->removeUser($this);
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
            $userMetrix->addUser($this);
        }

        return $this;
    }

    public function removeUserMetrix(UserMetrix $userMetrix): self
    {
        if ($this->userMetrixes->removeElement($userMetrix)) {
            $userMetrix->removeUser($this);
        }

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
            $userCategory->addUser($this);
        }

        return $this;
    }

    public function removeUserCategory(UserCategory $userCategory): self
    {
        if ($this->userCategories->removeElement($userCategory)) {
            $userCategory->removeUser($this);
        }

        return $this;
    }
}
