<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AchievementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AchievementRepository::class)]
#[ApiResource]
class Achievement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'datetime')]
    private $beginDate;

    #[ORM\Column(type: 'datetime')]
    private $endDate;

    #[ORM\Column(type: 'string', length: 255)]
    private $operateurComp;

    #[ORM\Column(type: 'float')]
    private $valeurComp;

    #[ORM\Column(type: 'integer')]
    private $periode;

    #[ORM\ManyToMany(targetEntity: UserAchievement::class, mappedBy: 'achievement')]
    private $user;

    #[ORM\ManyToOne(targetEntity: Metrix::class, inversedBy: 'achievements')]
    private $metrix;

    public function __construct()
    {
        $this->user = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBeginDate(): ?\DateTimeInterface
    {
        return $this->beginDate;
    }

    public function setBeginDate(\DateTimeInterface $beginDate): self
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getOperateurComp(): ?string
    {
        return $this->operateurComp;
    }

    public function setOperateurComp(string $operateurComp): self
    {
        $this->operateurComp = $operateurComp;

        return $this;
    }

    public function getValeurComp(): ?float
    {
        return $this->valeurComp;
    }

    public function setValeurComp(float $valeurComp): self
    {
        $this->valeurComp = $valeurComp;

        return $this;
    }

    public function getPeriode(): ?int
    {
        return $this->periode;
    }

    public function setPeriode(int $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    /**
     * @return Collection|UserAchievement[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(UserAchievement $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->addAchievement($this);
        }

        return $this;
    }

    public function removeUser(UserAchievement $user): self
    {
        if ($this->user->removeElement($user)) {
            $user->removeAchievement($this);
        }

        return $this;
    }

    public function getMetrix(): ?Metrix
    {
        return $this->metrix;
    }

    public function setMetrix(?Metrix $metrix): self
    {
        $this->metrix = $metrix;

        return $this;
    }
}
