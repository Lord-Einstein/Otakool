<?php

namespace App\Entity;

use App\Entity\Impl\BaseEntity;
use App\Entity\Trait\IdentificationTrait;
use App\Repository\ConversationRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: ConversationRepository::class)]
#[HasLifecycleCallbacks]
class Conversation extends BaseEntity
{
    use IdentificationTrait;

    #[ORM\Column(nullable: true)]
    private ?DateTime $lastMessageAt = null;

    public function getLastMessageAt(): ?DateTime
    {
        return $this->lastMessageAt;
    }

    public function setLastMessageAt(?DateTime $lastMessageAt): static
    {
        $this->lastMessageAt = $lastMessageAt;

        return $this;
    }
}
