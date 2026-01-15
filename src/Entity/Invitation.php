<?php

namespace App\Entity;

use App\Entity\Impl\BaseEntity;
use App\Entity\Trait\IdentificationTrait;
use App\Repository\InvitationRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: InvitationRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Invitation extends BaseEntity
{
    use IdentificationTrait;
    #[ORM\ManyToOne(inversedBy: 'sentInvitations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $sender = null;

    #[ORM\ManyToOne(inversedBy: 'receivedInvitations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $recipient = null;

    // les status possibles pour m'en rappeler 'PENDING', 'ACCEPTED', 'REJECTED'
    #[ORM\Column(length: 20)]
    private ?string $status = null;

    #[ORM\Column(nullable: true)]
    private ?DateTime $acceptedAt = null;

    public function getSender(): ?User
    {
        return $this->sender;
    }

    public function setSender(?User $sender): static
    {
        $this->sender = $sender;

        return $this;
    }

    public function getRecipient(): ?User
    {
        return $this->recipient;
    }

    public function setRecipient(?User $recipient): static
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getAcceptedAt(): ?DateTime
    {
        return $this->acceptedAt;
    }

    public function setAcceptedAt(?DateTime $acceptedAt): static
    {
        $this->acceptedAt = $acceptedAt;

        return $this;
    }
}
