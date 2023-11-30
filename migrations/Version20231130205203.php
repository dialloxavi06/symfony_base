<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231130205203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE price_vetement DROP FOREIGN KEY FK_5E027DD8D614C7E7');
        $this->addSql('ALTER TABLE price_vetement DROP FOREIGN KEY FK_5E027DD8969D8B67');
        $this->addSql('DROP TABLE price_vetement');
        $this->addSql('ALTER TABLE vetement ADD price_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vetement ADD CONSTRAINT FK_3CB446CFD614C7E7 FOREIGN KEY (price_id) REFERENCES price (id)');
        $this->addSql('CREATE INDEX IDX_3CB446CFD614C7E7 ON vetement (price_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE price_vetement (price_id INT NOT NULL, vetement_id INT NOT NULL, INDEX IDX_5E027DD8969D8B67 (vetement_id), INDEX IDX_5E027DD8D614C7E7 (price_id), PRIMARY KEY(price_id, vetement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE price_vetement ADD CONSTRAINT FK_5E027DD8D614C7E7 FOREIGN KEY (price_id) REFERENCES price (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE price_vetement ADD CONSTRAINT FK_5E027DD8969D8B67 FOREIGN KEY (vetement_id) REFERENCES vetement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vetement DROP FOREIGN KEY FK_3CB446CFD614C7E7');
        $this->addSql('DROP INDEX IDX_3CB446CFD614C7E7 ON vetement');
        $this->addSql('ALTER TABLE vetement DROP price_id');
    }
}
