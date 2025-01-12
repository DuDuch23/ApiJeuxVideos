<?php

namespace App\DataFixtures;

use App\Entity\Editor; // Assure-toi que l'entité Editor existe
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EditorFixtures extends Fixture
{
    public const BLIZZARD = "EDITOR_BLIZZARD";
    public const EA_SPORTS = "EDITOR_EA_SPORTS";
    public const UBISOFT = "EDITOR_UBISOFT";
    public const ROCKSTAR_GAMES = "EDITOR_ROCKSTAR_GAMES";
    public const SQUARE_ENIX = "EDITOR_SQUARE_ENIX";
    public const NINTENDO = "EDITOR_NINTENDO";
    public const ACTIVISION = "EDITOR_ACTIVISION";
    public const SEGA = "EDITOR_SEGA";
    public const CAPCOM = "EDITOR_CAPCOM";
    public const BETHESDA = "EDITOR_BETHESDA";
    public const BUNGIE = "EDITOR_BUNGIE";
    public const BANDAI_NAMCO = "EDITOR_BANDAI_NAMCO";
    public const EPIC_GAMES = "EDITOR_EPIC_GAMES";
    public const SONY = "EDITOR_SONY";
    public const MOJANG = "EDITOR_MOJANG";
    public const RIOT_GAMES = "EDITOR_RIOT_GAMES";
    public const CD_PROJEKT = "EDITOR_CD_PROJEKT";

    public const EDITORS = [
        self::BLIZZARD => [
            "name" => "Blizzard",
            "country" => "United States",
        ],
        self::EA_SPORTS => [
            "name" => "Electronic Arts (EA)",
            "country" => "United States",
        ],
        self::UBISOFT => [
            "name" => "Ubisoft",
            "country" => "France",
        ],
        self::ROCKSTAR_GAMES => [
            "name" => "Rockstar Games",
            "country" => "United States",
        ],
        self::SQUARE_ENIX => [
            "name" => "Square Enix",
            "country" => "Japan",
        ],
        self::NINTENDO => [
            "name" => "Nintendo",
            "country" => "Japan",
        ],
        self::ACTIVISION => [
            "name" => "Activision",
            "country" => "United States",
        ],
        self::SEGA => [
            "name" => "Sega",
            "country" => "Japan",
        ],
        self::CAPCOM => [
            "name" => "Capcom",
            "country" => "Japan",
        ],
        self::BETHESDA => [
            "name" => "Bethesda",
            "country" => "United States",
        ],
        self::BUNGIE => [
            'name' => 'Bungie',
            'country' => 'United States',
        ],
        self::BANDAI_NAMCO => [
            'name' => 'Bandai Namco',
            'country' => 'Japan',
        ],
        self::EPIC_GAMES => [
            'name' => 'Epic Games',
            'country' => 'United States',
        ],
        self::SONY => [
            'name' => 'Sony',
            'country' => 'Japan',
        ],
        self::MOJANG => [
            'name' => 'Mojang',
            'country' => 'Sweden',
        ],
        self::RIOT_GAMES => [
            'name' => 'Riot Games',
            'country' => 'United States',
        ],
        self::CD_PROJEKT => [
            'name' => 'CD Projekt',
            'country' => 'Poland',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EDITORS as $code => $attributes) {
            $editor = new Editor();
            $editor->setName($attributes['name']); // Assure-toi que la méthode setName existe dans l'entité Editor
            $editor->setCountry($attributes['country']); // Assure-toi que la méthode setCountry existe dans l'entité Editor

            $manager->persist($editor);

            $this->addReference($code, $editor); // Ajoute la référence pour d'autres fixtures si besoin
        }

        $manager->flush();
    }
}