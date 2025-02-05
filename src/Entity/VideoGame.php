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
    #[Groups(['video_game:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['video_game:read'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['video_game:read'])]
    private ?\DateTime $releaseDate = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['video_game:read'])]
    private ?string $description = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $id_category = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Editor $id_editor = null;

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
        return $this->id_category;
    }

    public function setIdCategory(?Category $id_category): static
    {
        $this->id_category = $id_category;

        return $this;
    }

    public function getIdEditor(): ?Editor
    {
        return $this->id_editor;
    }

    public function setIdEditor(?Editor $id_editor): static
    {
        $this->id_editor = $id_editor;

        return $this;
    }
}
