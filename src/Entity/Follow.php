<?php

namespace App\Entity;

use App\Entity\Impl\BaseEntity;
use App\Entity\Trait\IdentificationTrait;
use App\Repository\FollowRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\Expr\Base;

#[ORM\Entity(repositoryClass: FollowRepository::class)]
#[ORM\UniqueConstraint(name: 'unique_user_follow', fields: ['follower', 'target'])]
#[ORM\HasLifecycleCallbacks]
class Follow extends BaseEntity
{
    use IdentificationTrait;

    #[ORM\ManyToOne(inversedBy: 'follows')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $follower = null;

    #[ORM\ManyToOne(inversedBy: 'followers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $target = null;


    public function getFollower(): ?User
    {
        return $this->follower;
    }

    public function setFollower(?User $follower): static
    {
        $this->follower = $follower;

        return $this;
    }

    public function getTarget(): ?User
    {
        return $this->target;
    }

    public function setTarget(?User $target): static
    {
        $this->target = $target;

        return $this;
    }
}
