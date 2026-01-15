<?php

namespace App\Entity;

use App\Entity\Impl\BaseEntity;
use App\Entity\Trait\IdentificationTrait;
use App\Repository\MediaAssetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaAssetRepository::class)]
#[ORM\HasLifecycleCallbacks]
class MediaAsset extends BaseEntity
{
    use IdentificationTrait;

    #[ORM\ManyToOne(inversedBy: 'mediaAssets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MediaPack $mediaPack = null;

    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    public function getMediaPack(): ?MediaPack
    {
        return $this->mediaPack;
    }

    public function setMediaPack(?MediaPack $mediaPack): static
    {
        $this->mediaPack = $mediaPack;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }
}
