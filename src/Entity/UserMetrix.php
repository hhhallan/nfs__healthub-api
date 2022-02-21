<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserMetrixRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserMetrixRepository::class)]
#[ApiResource]
class UserMetrix
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'userMetrixes')]
    private $user;

    #[ORM\ManyToMany(targetEntity: Metrix::class, inversedBy: 'userMetrixes')]
    private $metrix;

    #[ORM\Column(type: 'float')]
    private $value;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->metrix = new ArrayCollection();
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
     * @return Collection|Metrix[]
     */
    public function getMetrix(): Collection
    {
        return $this->metrix;
    }

    public function addMetrix(Metrix $metrix): self
    {
        if (!$this->metrix->contains($metrix)) {
            $this->metrix[] = $metrix;
        }

        return $this;
    }

    public function removeMetrix(Metrix $metrix): self
    {
        $this->metrix->removeElement($metrix);

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }
}
