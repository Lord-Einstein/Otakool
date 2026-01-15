<?php

namespace App\Entity;

use App\Entity\Impl\BaseEntity;
use App\Entity\Trait\IdentificationTrait;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Post extends BaseEntity
{
    use IdentificationTrait;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mediaName = null;

    #[ORM\Column(options: ["default" => 0])]
    private int $viewCount = 0;

    #[ORM\Column(length: 50, options: ["default" => 'published'])]
    private string $status = 'published';

    #[ORM\Column(options: ["default" => '{}' ])]
    private array $metadata = [];

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'replies')]
    private ?self $parent = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent')]
    private Collection $replies;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'reposts')]
    private ?self $source = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'source')]
    private Collection $reposts;

    /**
     * @var Collection<int, Interaction>
     */
    #[ORM\OneToMany(targetEntity: Interaction::class, mappedBy: 'post', orphanRemoval: true)]
    private Collection $interactions;

    /**
     * @var Collection<int, ModerationVote>
     */
    #[ORM\OneToMany(targetEntity: ModerationVote::class, mappedBy: 'post', orphanRemoval: true)]
    private Collection $moderationVotes;

    public function __construct()
    {
        $this->replies = new ArrayCollection();
        $this->reposts = new ArrayCollection();
        $this->interactions = new ArrayCollection();
        $this->moderationVotes = new ArrayCollection();
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getMediaName(): ?string
    {
        return $this->mediaName;
    }

    public function setMediaName(?string $mediaName): static
    {
        $this->mediaName = $mediaName;

        return $this;
    }

    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    public function setViewCount(int $viewCount): static
    {
        $this->viewCount = $viewCount;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }

    public function setMetadata(array $metadata): static
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getReplies(): Collection
    {
        return $this->replies;
    }

    public function addReply(self $reply): static
    {
        if (!$this->replies->contains($reply)) {
            $this->replies->add($reply);
            $reply->setParent($this);
        }

        return $this;
    }

    public function removeReply(self $reply): static
    {
        if ($this->replies->removeElement($reply)) {
            // set the owning side to null (unless already changed)
            if ($reply->getParent() === $this) {
                $reply->setParent(null);
            }
        }

        return $this;
    }

    public function getSource(): ?self
    {
        return $this->source;
    }

    public function setSource(?self $source): static
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getReposts(): Collection
    {
        return $this->reposts;
    }

    public function addRepost(self $repost): static
    {
        if (!$this->reposts->contains($repost)) {
            $this->reposts->add($repost);
            $repost->setSource($this);
        }

        return $this;
    }

    public function removeRepost(self $repost): static
    {
        if ($this->reposts->removeElement($repost)) {
            // set the owning side to null (unless already changed)
            if ($repost->getSource() === $this) {
                $repost->setSource(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Interaction>
     */
    public function getInteractions(): Collection
    {
        return $this->interactions;
    }

    public function addInteraction(Interaction $interaction): static
    {
        if (!$this->interactions->contains($interaction)) {
            $this->interactions->add($interaction);
            $interaction->setPost($this);
        }

        return $this;
    }

    public function removeInteraction(Interaction $interaction): static
    {
        if ($this->interactions->removeElement($interaction)) {
            // set the owning side to null (unless already changed)
            if ($interaction->getPost() === $this) {
                $interaction->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ModerationVote>
     */
    public function getModerationVotes(): Collection
    {
        return $this->moderationVotes;
    }

    public function addModerationVote(ModerationVote $moderationVote): static
    {
        if (!$this->moderationVotes->contains($moderationVote)) {
            $this->moderationVotes->add($moderationVote);
            $moderationVote->setPost($this);
        }

        return $this;
    }

    public function removeModerationVote(ModerationVote $moderationVote): static
    {
        if ($this->moderationVotes->removeElement($moderationVote)) {
            // set the owning side to null (unless already changed)
            if ($moderationVote->getPost() === $this) {
                $moderationVote->setPost(null);
            }
        }

        return $this;
    }
}
