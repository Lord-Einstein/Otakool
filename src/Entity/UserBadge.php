<?php

namespace App\Entity;

use App\Entity\Impl\BaseEntity;
use App\Entity\Trait\IdentificationTrait;
use App\Repository\UserBadgeRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserBadgeRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\UniqueConstraint(name: 'unique_badge_by_user', fields: ['owner', 'badge'])]
class UserBadge extends BaseEntity
{
    use IdentificationTrait;

    #[ORM\ManyToOne(inversedBy: 'userBadges')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\ManyToOne(inversedBy: 'achievers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Badge $badge = null;

    #[ORM\Column]
    private ?DateTime $acquiredAt = null;

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getBadge(): ?Badge
    {
        return $this->badge;
    }

    public function setBadge(?Badge $badge): static
    {
        $this->badge = $badge;

        return $this;
    }

    public function getAcquiredAt(): ?DateTime
    {
        return $this->acquiredAt;
    }

    public function setAcquiredAt(DateTime $acquiredAt): static
    {
        $this->acquiredAt = $acquiredAt;

        return $this;
    }
}
