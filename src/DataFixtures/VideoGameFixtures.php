<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Editor;
use App\Entity\VideoGame;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VideoGameFixtures extends Fixture
{
    public const VIDEOSGAMES = [
        [
            'title' => 'World of Warcraft',
            'releaseDate' => '2004/11/23',
            'description' => 'World of Warcraft est un jeu vidéo de type MMORPG développé par la société Blizzard Entertainment. 
            C\'est le 4ᵉ jeu de l\'univers médiéval-fantastique Warcraft, introduit par Warcraft: Orcs and Humans en 1994.',
            'categorie' => CategoryFixtures::MMORPG,
            'editor' => EditorFixtures::BLIZZARD,
        ],
        [
            'title' => 'The Elder Scrolls V: Skyrim',
            'releaseDate' => '2011/11/11',
            'description' => 'Skyrim est un jeu de rôle immersif en monde ouvert se déroulant dans un univers fantasy développé par Bethesda.',
            'categorie' => CategoryFixtures::MMORPG,
            'editor' => EditorFixtures::BETHESDA,
        ],
        [
            'title' => 'League of Legends',
            'releaseDate' => '2009/10/27',
            'description' => 'League of Legends est un jeu de type MOBA développé par Riot Games, où des équipes s\'affrontent pour détruire la base ennemie.',
            'categorie' => CategoryFixtures::MOBA,
            'editor' => EditorFixtures::RIOT_GAMES,
        ],
        [
            'title' => 'The Witcher 3: Wild Hunt',
            'releaseDate' => '2015/05/19',
            'description' => 'The Witcher 3 est un jeu d\'action-RPG développé par CD Projekt, racontant l\'histoire de Geralt de Riv.',
            'categorie' => CategoryFixtures::MMORPG,
            'editor' => EditorFixtures::CD_PROJEKT,
        ],
        [
            'title' => 'Call of Duty: Modern Warfare',
            'releaseDate' => '2019/10/25',
            'description' => 'Modern Warfare est un jeu de tir à la première personne développé par Infinity Ward et publié par Activision.',
            'categorie' => CategoryFixtures::FPS,
            'editor' => EditorFixtures::ACTIVISION,
        ],
        [
            'title' => 'Assassin’s Creed Valhalla',
            'releaseDate' => '2020/11/10',
            'description' => 'Valhalla est un jeu d\'action-aventure développé par Ubisoft, où le joueur incarne un viking.',
            'categorie' => CategoryFixtures::ACTION,
            'editor' => EditorFixtures::UBISOFT,
        ],
        [
            'title' => 'FIFA 22',
            'releaseDate' => '2021/10/01',
            'description' => 'FIFA 22 est un jeu de simulation de football développé par EA Sports.',
            'categorie' => CategoryFixtures::SPORT,
            'editor' => EditorFixtures::EA_SPORTS,
        ],
        [
            'title' => 'Minecraft',
            'releaseDate' => '2011/11/18',
            'description' => 'Minecraft est un jeu de type sandbox développé par Mojang, où les joueurs explorent, construisent et survivent.',
            'categorie' => CategoryFixtures::SANDBOX,
            'editor' => EditorFixtures::MOJANG,
        ],
        [
            'title' => 'Fortnite',
            'releaseDate' => '2017/07/25',
            'description' => 'Fortnite est un jeu de type Battle Royale développé par Epic Games.',
            'categorie' => CategoryFixtures::BATTLE_ROYALE,
            'editor' => EditorFixtures::EPIC_GAMES,
        ],
        [
            'title' => 'Horizon Zero Dawn',
            'releaseDate' => '2017/02/28',
            'description' => 'Horizon Zero Dawn est un jeu d\'action-RPG développé par Guerrilla Games, dans un monde post-apocalyptique dominé par des machines.',
            'categorie' => CategoryFixtures::MMORPG,
            'editor' => EditorFixtures::SONY,
        ],
        [
            'title' => 'God of War',
            'releaseDate' => '2018/04/20',
            'description' => 'God of War est un jeu d\'action-aventure développé par Santa Monica Studio, inspiré de la mythologie nordique.',
            'categorie' => CategoryFixtures::ACTION,
            'editor' => EditorFixtures::SONY,
        ],
        [
            'title' => 'Cyberpunk 2077',
            'releaseDate' => '2020/12/10',
            'description' => 'Cyberpunk 2077 est un jeu de rôle développé par CD Projekt, situé dans un univers futuriste dystopique.',
            'categorie' => CategoryFixtures::MMORPG,
            'editor' => EditorFixtures::CD_PROJEKT,
        ],
        [
            'title' => 'Overwatch',
            'releaseDate' => '2016/05/24',
            'description' => 'Overwatch est un jeu de tir en équipe développé par Blizzard Entertainment.',
            'categorie' => CategoryFixtures::FPS,
            'editor' => EditorFixtures::BLIZZARD,
        ],
        [
            'title' => 'Grand Theft Auto V',
            'releaseDate' => '2013/09/17',
            'description' => 'GTA V est un jeu d\'action en monde ouvert développé par Rockstar Games.',
            'categorie' => CategoryFixtures::OPEN_WORLD,
            'editor' => EditorFixtures::ROCKSTAR_GAMES,
        ],
        [
            'title' => 'The Legend of Zelda: Breath of the Wild',
            'releaseDate' => '2017/03/03',
            'description' => 'Breath of the Wild est un jeu d\'action-aventure développé par Nintendo.',
            'categorie' => CategoryFixtures::AVENTURE,
            'editor' => EditorFixtures::NINTENDO,
        ],
        [
            'title' => 'Animal Crossing: New Horizons',
            'releaseDate' => '2020/03/20',
            'description' => 'Animal Crossing est un jeu de simulation de vie développé par Nintendo.',
            'categorie' => CategoryFixtures::SIMULATION,
            'editor' => EditorFixtures::NINTENDO,
        ],
        [
            'title' => 'Dark Souls III',
            'releaseDate' => '2016/04/12',
            'description' => 'Dark Souls III est un jeu d\'action-RPG développé par FromSoftware.',
            'categorie' => CategoryFixtures::MMORPG,
            'editor' => EditorFixtures::BANDAI_NAMCO,
        ],
        [
            'title' => 'Pokémon Sword and Shield',
            'releaseDate' => '2019/11/15',
            'description' => 'Pokémon Sword and Shield est un jeu de rôle développé par Game Freak.',
            'categorie' => CategoryFixtures::MMORPG,
            'editor' => EditorFixtures::NINTENDO,
        ],
        [
            'title' => 'Destiny 2',
            'releaseDate' => '2017/09/06',
            'description' => 'Destiny 2 est un jeu de tir à la première personne multijoueur développé par Bungie.',
            'categorie' => CategoryFixtures::FPS,
            'editor' => EditorFixtures::BUNGIE,
        ],
        [
            'title' => 'Red Dead Redemption 2',
            'releaseDate' => '2018/10/26',
            'description' => 'Red Dead Redemption 2 est un jeu d\'action-aventure en monde ouvert développé par Rockstar Games.',
            'categorie' => CategoryFixtures::OPEN_WORLD,
            'editor' => EditorFixtures::ROCKSTAR_GAMES,
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach(self::VIDEOSGAMES as $attributes){
            $videoGame = new VideoGame();
            $videoGame->setTitle($attributes['title']);

            $releaseDate = \DateTime::createFromFormat('Y/m/d', $attributes['releaseDate']);
            $videoGame->setReleaseDate($releaseDate);

            $videoGame->setDescription($attributes['description']);

            $categoryReference = $attributes['categorie'];
            $category = $this->getReference($categoryReference, Category::class);
            $videoGame->setCategory($category);

            $editorReference = $attributes['editor'];
            $editor = $this->getReference($editorReference, Editor::class);
            $videoGame->setEditor($editor);

            $manager->persist($videoGame);
        }

        $manager->flush();
    }

    public function GetDependencies(): array
    {
        return [
            CategoryFixtures::class,
            EditorFixtures::class,
        ];
    }
}
