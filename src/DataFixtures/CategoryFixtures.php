<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Thematic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const ACTION = 'CATEGORY_ACTION';
    public const AVENTURE = 'CATEGORY_AVENTURE';
    public const MMORPG = 'CATEGORY_RPG';
    public const FPS = 'CATEGORY_FPS';
    public const STRATEGIE = 'CATEGORY_STRATEGIE';
    public const SIMULATION = 'CATEGORY_SIMULATION';
    public const SPORT = 'CATEGORY_SPORT';
    public const SURVIVAL_HORROR = 'CATEGORY_SURVIVAL_HORROR';
    public const PLATEFORME = 'CATEGORY_PLATEFORME';
    public const PUZZLE = 'CATEGORY_PUZZLE';
    public const MOBA = 'CATEGORY_MOBA';
    public const SANDBOX = 'CATEGORY_SANDBOX';
    public const BATTLE_ROYALE = 'CATEGORY_BATTLE_ROYALE';
    public const OPEN_WORLD = 'CATEGORY_OPEN_WORLD';

    public const CATEGORIES = [
        self::ACTION => [
            'name' => 'Action'
        ],
        self::AVENTURE => [
            'name' => 'Aventure'
        ],
        self::MMORPG => [
            'name' => 'MMORPG' // Jeu de rôle
        ],
        self::FPS => [
            'name' => 'FPS' // First Person Shooter
        ],
        self::STRATEGIE => [
            'name' => 'Stratégie'
        ],
        self::SIMULATION => [
            'name' => 'Simulation'
        ],
        self::SPORT => [
            'name' => 'Sport'
        ],
        self::SURVIVAL_HORROR => [
            'name' => 'Survival Horror'
        ],
        self::PLATEFORME => [
            'name' => 'Plateforme'
        ],
        self::PUZZLE => [
            'name' => 'Puzzle'
        ],
        self::MOBA => [
            'name' => 'Moba'
        ],
        self::SANDBOX => [
            'name' => 'Sandbox'
        ],
        self::BATTLE_ROYALE => [
            'name' => 'Battle royale'
        ],
        self::OPEN_WORLD => [
            'name' => 'Open world',
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this::CATEGORIES as $code => $attributes) {
            $category = new Category();
            $category->setName($attributes['name']);

            $manager->persist($category);

            $this->addReference($code, $category);
        }

        $manager->flush();
    }
}