<?php

namespace App\Entity;

use App\Entity\Impl\BaseEntity;
use App\Entity\Trait\IdentificationTrait;
use App\Repository\ParticipantRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: ParticipantRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\UniqueConstraint(name: 'unique_user_in_conversation', fields: ['conversation', 'user'])]
class Participant extends BaseEntity
{
    use IdentificationTrait;

    #[ORM\ManyToOne(inversedBy: 'conversationParticipants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $participant = null;

    #[ORM\ManyToOne(inversedBy: 'participants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Conversation $conversation = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $lastReadAt = null;

    public function getParticipant(): ?User
    {
        return $this->participant;
    }

    public function setParticipant(?User $participant): static
    {
        $this->participant = $participant;

        return $this;
    }

    public function getConversation(): ?Conversation
    {
        return $this->conversation;
    }

    public function setConversation(?Conversation $conversation): static
    {
        $this->conversation = $conversation;

        return $this;
    }

    public function getLastReadAt(): ?\DateTime
    {
        return $this->lastReadAt;
    }

    public function setLastReadAt(?\DateTime $lastReadAt): static
    {
        $this->lastReadAt = $lastReadAt;

        return $this;
    }
}
