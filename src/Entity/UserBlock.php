<?php

namespace App\Entity;

use App\Entity\Impl\BaseEntity;
use App\Entity\Trait\IdentificationTrait;
use App\Repository\UserBlockRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserBlockRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\UniqueConstraint(name: 'unique_user_block', fields: ['blocker', 'blocked'])]
class UserBlock extends BaseEntity
{
    use IdentificationTrait;

    #[ORM\ManyToOne(inversedBy: 'blocking')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $blocker = null;

    #[ORM\ManyToOne(inversedBy: 'blockedBy')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $blocked = null;

    public function getBlocker(): ?User
    {
        return $this->blocker;
    }

    public function setBlocker(?User $blocker): static
    {
        $this->blocker = $blocker;

        return $this;
    }

    public function getBlocked(): ?User
    {
        return $this->blocked;
    }

    public function setBlocked(?User $blocked): static
    {
        $this->blocked = $blocked;

        return $this;
    }
}
