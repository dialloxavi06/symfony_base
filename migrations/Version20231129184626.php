<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129184626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, vetement_id INT NOT NULL, contenu VARCHAR(255) DEFAULT NULL, INDEX IDX_67F068BC969D8B67 (vetement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, vetement_id INT NOT NULL, chemin VARCHAR(255) DEFAULT NULL, INDEX IDX_C53D045F969D8B67 (vetement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille (id INT AUTO_INCREMENT NOT NULL, vetement_id INT NOT NULL, nom VARCHAR(20) NOT NULL, INDEX IDX_76508B38969D8B67 (vetement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vetement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, marques VARCHAR(255) NULL, tailles VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC969D8B67 FOREIGN KEY (vetement_id) REFERENCES vetement (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F969D8B67 FOREIGN KEY (vetement_id) REFERENCES vetement (id)');
        $this->addSql('ALTER TABLE taille ADD CONSTRAINT FK_76508B38969D8B67 FOREIGN KEY (vetement_id) REFERENCES vetement (id)');
        $this->addSql('DROP TABLE first');
        $this->addSql('ALTER TABLE ingredient CHANGE name name VARCHAR(50) NOT NULL, CHANGE price price DOUBLE PRECISION DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE first (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC969D8B67');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F969D8B67');
        $this->addSql('ALTER TABLE taille DROP FOREIGN KEY FK_76508B38969D8B67');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE taille');
        $this->addSql('DROP TABLE vetement');
        $this->addSql('ALTER TABLE ingredient CHANGE name name VARCHAR(255) NOT NULL, CHANGE price price DOUBLE PRECISION NOT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
