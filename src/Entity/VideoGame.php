<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VideoGameRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VideoGameRepository::class)]
#[ApiResource]
class VideoGame
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['videogame:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['videogame:read'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['videogame:read'])]
    private ?\DateTime $releaseDate = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['videogame:read'])]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: Category::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['videogame:read', 'category:read'])]
    private ?Category $category = null;

    #[ORM\ManyToOne(targetEntity: Editor::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['videogame:read', 'editor:read'])]
    private ?Editor $editor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getReleaseDate(): ?\DateTime
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTime $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getIdCategory(): ?Category
    {
        return $this->category;
    }

    public function setIdCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getIdEditor(): ?Editor
    {
        return $this->editor;
    }

    public function setIdEditor(?Editor $editor): static
    {
        $this->editor = $editor;

        return $this;
    }
}
