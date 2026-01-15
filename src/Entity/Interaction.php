<?php

namespace App\Entity;

use App\Entity\Impl\BaseEntity;
use App\Entity\Trait\IdentificationTrait;
use App\Repository\InteractionRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\Expr\Base;

#[ORM\HasLifecycleCallbacks]
// REndre unique la combinaison de chaque lignes contenant ces deux champs
#[ORM\UniqueConstraint(name: 'unique_interaction_per_user', fields: ['post', 'author', 'type'])]
#[ORM\Entity(repositoryClass: InteractionRepository::class)]
class Interaction extends BaseEntity
{
    use IdentificationTrait;

    #[ORM\ManyToOne(inversedBy: 'interactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $post = null;

    #[ORM\ManyToOne(inversedBy: 'interactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    // a préciser après mais les options auxquelles je pense : like, bookmark, share, love
    #[ORM\Column(length: 50)]
    private ?string $type = null;


    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): static
    {
        $this->post = $post;

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
