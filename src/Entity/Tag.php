<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $label = null;

    #[ORM\ManyToMany(targetEntity: Article::class, inversedBy: 'tags')]
    private Collection $tag_article;

    public function __construct()
    {
        $this->tag_article = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getTagArticle(): Collection
    {
        return $this->tag_article;
    }

    public function addTagArticle(Article $tagArticle): self
    {
        if (!$this->tag_article->contains($tagArticle)) {
            $this->tag_article->add($tagArticle);
        }

        return $this;
    }

    public function removeTagArticle(Article $tagArticle): self
    {
        $this->tag_article->removeElement($tagArticle);

        return $this;
    }
}
