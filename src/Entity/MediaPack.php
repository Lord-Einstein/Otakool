<?php

namespace App\Entity;

use App\Entity\Impl\BaseEntity;
use App\Entity\Trait\IdentificationTrait;
use App\Repository\MediaPackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaPackRepository::class)]
#[ORM\HasLifecycleCallbacks]
class MediaPack extends BaseEntity
{
    use IdentificationTrait;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $isPremiumOnly = false;

    /**
     * @var Collection<int, MediaAsset>
     */
    #[ORM\OneToMany(targetEntity: MediaAsset::class, mappedBy: 'mediaPack', orphanRemoval: true)]
    private Collection $mediaAssets;

    public function __construct()
    {
        $this->mediaAssets = new ArrayCollection();
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

    public function isPremiumOnly(): ?bool
    {
        return $this->isPremiumOnly;
    }

    public function setIsPremiumOnly(bool $isPremiumOnly): static
    {
        $this->isPremiumOnly = $isPremiumOnly;

        return $this;
    }

    /**
     * @return Collection<int, MediaAsset>
     */
    public function getMediaAssets(): Collection
    {
        return $this->mediaAssets;
    }

    public function addMediaAsset(MediaAsset $mediaAsset): static
    {
        if (!$this->mediaAssets->contains($mediaAsset)) {
            $this->mediaAssets->add($mediaAsset);
            $mediaAsset->setMediaPack($this);
        }

        return $this;
    }

    public function removeMediaAsset(MediaAsset $mediaAsset): static
    {
        if ($this->mediaAssets->removeElement($mediaAsset)) {
            // set the owning side to null (unless already changed)
            if ($mediaAsset->getMediaPack() === $this) {
                $mediaAsset->setMediaPack(null);
            }
        }

        return $this;
    }
}
