<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231201121916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chaussure ADD nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE marque ADD chaussure_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE marque ADD CONSTRAINT FK_5A6F91CEF8458E35 FOREIGN KEY (chaussure_id) REFERENCES chaussure (id)');
        $this->addSql('CREATE INDEX IDX_5A6F91CEF8458E35 ON marque (chaussure_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marque DROP FOREIGN KEY FK_5A6F91CEF8458E35');
        $this->addSql('DROP INDEX IDX_5A6F91CEF8458E35 ON marque');
        $this->addSql('ALTER TABLE marque DROP chaussure_id');
        $this->addSql('ALTER TABLE chaussure DROP nom');
    }
}
