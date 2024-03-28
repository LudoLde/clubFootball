<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240328124502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, club_id INT NOT NULL, first_name VARCHAR(40) NOT NULL, nom VARCHAR(40) NOT NULL, age INT NOT NULL, numero INT NOT NULL, poste VARCHAR(40) DEFAULT NULL, date_naissance DATE DEFAULT NULL, nationalite VARCHAR(40) DEFAULT NULL, INDEX IDX_FD71A9C561190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C561190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('DROP TABLE player');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, number INT NOT NULL, age INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C561190A32');
        $this->addSql('DROP TABLE joueur');
    }
}
