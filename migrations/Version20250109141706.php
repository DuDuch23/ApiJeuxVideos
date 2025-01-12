<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250109141706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_game (id INT AUTO_INCREMENT NOT NULL, id_category_id INT NOT NULL, id_editor_id INT NOT NULL, title VARCHAR(255) NOT NULL, release_date DATE NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_24BC6C50A545015 (id_category_id), INDEX IDX_24BC6C50E9A0106B (id_editor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video_game ADD CONSTRAINT FK_24BC6C50A545015 FOREIGN KEY (id_category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE video_game ADD CONSTRAINT FK_24BC6C50E9A0106B FOREIGN KEY (id_editor_id) REFERENCES editor (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video_game DROP FOREIGN KEY FK_24BC6C50A545015');
        $this->addSql('ALTER TABLE video_game DROP FOREIGN KEY FK_24BC6C50E9A0106B');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE editor');
        $this->addSql('DROP TABLE video_game');
    }
}
