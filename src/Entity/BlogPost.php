<?php
// src/Entity/BlogPost.php

namespace App\Entity;

use App\Repository\BlogPostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Enum\SerializationGroup;

#[ORM\Entity(repositoryClass: BlogPostRepository::class)]
#[ORM\Table(name: 'blog_posts')]
class BlogPost
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[Groups([SerializationGroup::GENERAL->value, SerializationGroup::DETAILS->value])]
    private Uuid $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups([SerializationGroup::GENERAL->value, SerializationGroup::DETAILS->value])]
    private string $title;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups([SerializationGroup::GENERAL->value, SerializationGroup::DETAILS->value])]
    private string $subtitle;

    #[ORM\Column(type: 'text')]
    #[Groups([SerializationGroup::GENERAL->value, SerializationGroup::DETAILS->value])]
    private string $content; // WYSIWYG content

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups([SerializationGroup::GENERAL->value, SerializationGroup::DETAILS->value])]
    private string $featuredImage;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children')]
    #[Groups([SerializationGroup::DETAILS->value])]
    private ?BlogPost $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    #[Groups([SerializationGroup::DETAILS->value])]
    private Collection $children;

    #[ORM\ManyToOne(targetEntity: Author::class, inversedBy: 'blogPosts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([SerializationGroup::DETAILS->value])]
    private Author $author;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }
    public function setId(Uuid $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getFeaturedImage(): string
    {
        return $this->featuredImage;
    }

    public function setFeaturedImage(string $featuredImage): self
    {
        $this->featuredImage = $featuredImage;
        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;
        return $this;
    }

    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChildren(BlogPost $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }
        return $this;
    }

    public function removeChildren(BlogPost $child): self
    {
        if ($this->children->removeElement($child)) {
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }
        return $this;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function setAuthor(Author $author): self
    {
        $this->author = $author;
        return $this;
    }
}


