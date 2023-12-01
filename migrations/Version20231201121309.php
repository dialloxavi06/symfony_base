<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231201121309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chaussure (id INT AUTO_INCREMENT NOT NULL, prix_id INT DEFAULT NULL, pointure DOUBLE PRECISION NOT NULL, INDEX IDX_43D47897944722F2 (prix_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chaussure ADD CONSTRAINT FK_43D47897944722F2 FOREIGN KEY (prix_id) REFERENCES price (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chaussure DROP FOREIGN KEY FK_43D47897944722F2');
        $this->addSql('DROP TABLE chaussure');
    }
}
