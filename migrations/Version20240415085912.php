<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240415085912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coordination (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, localite VARCHAR(255) NOT NULL, president VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, coordination_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, lieu_naissance VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, contact_cas_urgent VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, qualite VARCHAR(255) NOT NULL, niveau VARCHAR(255) DEFAULT NULL, ville_actuelle VARCHAR(255) DEFAULT NULL, INDEX IDX_F6B4FB299473E195 (coordination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL , available_at DATETIME NOT NULL , delivered_at DATETIME DEFAULT NULL , INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB299473E195 FOREIGN KEY (coordination_id) REFERENCES coordination (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB299473E195');
        $this->addSql('DROP TABLE coordination');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
