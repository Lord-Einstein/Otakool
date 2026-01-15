<?php

namespace App\Entity;

use App\Entity\Impl\BaseEntity;
use App\Entity\Trait\IdentificationTrait;
use App\Repository\BadgeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BadgeRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Badge extends BaseEntity
{
    use IdentificationTrait;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $iconName = null;

    #[ORM\Column(length: 50)]
    private ?string $conditionRule = null;

    /**
     * @var Collection<int, UserBadge>
     */
    #[ORM\OneToMany(targetEntity: UserBadge::class, mappedBy: 'badge', orphanRemoval: true)]
    private Collection $achievers;

    public function __construct()
    {
        $this->achievers = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getIconName(): ?string
    {
        return $this->iconName;
    }

    public function setIconName(string $iconName): static
    {
        $this->iconName = $iconName;

        return $this;
    }

    public function getConditionRule(): ?string
    {
        return $this->conditionRule;
    }

    public function setConditionRule(string $conditionRule): static
    {
        $this->conditionRule = $conditionRule;

        return $this;
    }

    /**
     * @return Collection<int, UserBadge>
     */
    public function getAchievers(): Collection
    {
        return $this->achievers;
    }

    public function addAchiever(UserBadge $achiever): static
    {
        if (!$this->achievers->contains($achiever)) {
            $this->achievers->add($achiever);
            $achiever->setBadge($this);
        }

        return $this;
    }

    public function removeAchiever(UserBadge $achiever): static
    {
        if ($this->achievers->removeElement($achiever)) {
            // set the owning side to null (unless already changed)
            if ($achiever->getBadge() === $this) {
                $achiever->setBadge(null);
            }
        }

        return $this;
    }
}
