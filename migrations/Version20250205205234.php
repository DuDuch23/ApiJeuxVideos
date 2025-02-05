<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250205205234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video_game DROP FOREIGN KEY FK_24BC6C50A545015');
        $this->addSql('ALTER TABLE video_game DROP FOREIGN KEY FK_24BC6C50E9A0106B');
        $this->addSql('DROP INDEX IDX_24BC6C50E9A0106B ON video_game');
        $this->addSql('DROP INDEX IDX_24BC6C50A545015 ON video_game');
        $this->addSql('ALTER TABLE video_game ADD category_id INT NOT NULL, ADD editor_id INT NOT NULL, ADD user_id INT DEFAULT NULL, DROP id_category_id, DROP id_editor_id');
        $this->addSql('ALTER TABLE video_game ADD CONSTRAINT FK_24BC6C5012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE video_game ADD CONSTRAINT FK_24BC6C506995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id)');
        $this->addSql('ALTER TABLE video_game ADD CONSTRAINT FK_24BC6C50A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_24BC6C5012469DE2 ON video_game (category_id)');
        $this->addSql('CREATE INDEX IDX_24BC6C506995AC4C ON video_game (editor_id)');
        $this->addSql('CREATE INDEX IDX_24BC6C50A76ED395 ON video_game (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video_game DROP FOREIGN KEY FK_24BC6C50A76ED395');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE video_game DROP FOREIGN KEY FK_24BC6C5012469DE2');
        $this->addSql('ALTER TABLE video_game DROP FOREIGN KEY FK_24BC6C506995AC4C');
        $this->addSql('DROP INDEX IDX_24BC6C5012469DE2 ON video_game');
        $this->addSql('DROP INDEX IDX_24BC6C506995AC4C ON video_game');
        $this->addSql('DROP INDEX IDX_24BC6C50A76ED395 ON video_game');
        $this->addSql('ALTER TABLE video_game ADD id_category_id INT NOT NULL, ADD id_editor_id INT NOT NULL, DROP category_id, DROP editor_id, DROP user_id');
        $this->addSql('ALTER TABLE video_game ADD CONSTRAINT FK_24BC6C50A545015 FOREIGN KEY (id_category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE video_game ADD CONSTRAINT FK_24BC6C50E9A0106B FOREIGN KEY (id_editor_id) REFERENCES editor (id)');
        $this->addSql('CREATE INDEX IDX_24BC6C50E9A0106B ON video_game (id_editor_id)');
        $this->addSql('CREATE INDEX IDX_24BC6C50A545015 ON video_game (id_category_id)');
    }
}
