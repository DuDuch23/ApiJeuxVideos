<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VideoGameRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


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
    #[Groups(['videogame:read', 'videogame:write'])]
    #[Assert\NotBlank(message: "Le titre du jeu vidéo est obligatoire")]
    #[Assert\Length(min: 3, max: 255, minMessage: "Le titre du jeu vidéo doit contenir au moins 3 caractères")]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['videogame:read', 'videogame:write'])]
    private ?\DateTime $releaseDate = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['videogame:read', 'videogame:write'])]
    #[Assert\NotBlank(message: "La description du jeu vidéo est obligatoire")]
    #[Assert\Length(min: 10, max: 255, minMessage: "Le description du jeu vidéo doit contenir au moins 10 caractères")]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: Category::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['videogame:read', 'category:read'])]
    #[Assert\NotNull(message: "Une catégorie est obligatoire.")]
    private ?Category $category = null;

    #[ORM\ManyToOne(targetEntity: Editor::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['videogame:read', 'editor:read'])]
    #[Assert\NotNull(message: "Un éditeur est obligatoire.")]
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }
    
    public function setCategory(?Category $category): static
    {
        $this->category = $category;
        return $this;
    }
    
    public function getEditor(): ?Editor
    {
        return $this->editor;
    }
    
    public function setEditor(?Editor $editor): static
    {
        $this->editor = $editor;
        return $this;
    }
}
