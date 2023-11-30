<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129200227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vetement ADD marques_id INT DEFAULT NULL, DROP marques');
        $this->addSql('ALTER TABLE vetement ADD CONSTRAINT FK_3CB446CFC256483C FOREIGN KEY (marques_id) REFERENCES marque (id)');
        $this->addSql('CREATE INDEX IDX_3CB446CFC256483C ON vetement (marques_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vetement DROP FOREIGN KEY FK_3CB446CFC256483C');
        $this->addSql('DROP INDEX IDX_3CB446CFC256483C ON vetement');
        $this->addSql('ALTER TABLE vetement ADD marques VARCHAR(255) NOT NULL, DROP marques_id');
    }
}
