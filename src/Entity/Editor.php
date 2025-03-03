<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EditorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: EditorRepository::class)]
#[ApiResource]
class Editor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['editor:read', 'videogame:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['editor:read', 'videogame:read'])]
    #[Assert\NotBlank(message: "Le nom de l'éditeur est obligatoire")]
    #[Assert\Length(min: 3, max: 255, minMessage: "Le nom de l'éditeur doit contenir au moins 3 caractères")]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['editor:read', 'videogame:read'])]
    #[Assert\NotBlank(message: "Le pays est obligatoire")]
    #[Assert\Length(min: 3, max: 255, minMessage: "Le pays doit contenir au moins 3 caractères")]
    private ?string $country = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }
}
