<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240425082700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, created_by INT DEFAULT NULL, deleted_by INT DEFAULT NULL, updated_by INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, sujet VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_4C62E638DE12AB56 (created_by), INDEX IDX_4C62E6381F6FA0AF (deleted_by), INDEX IDX_4C62E63816FE72E1 (updated_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coordination (id INT AUTO_INCREMENT NOT NULL, created_by INT DEFAULT NULL, deleted_by INT DEFAULT NULL, updated_by INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, localite VARCHAR(255) NOT NULL, president VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_2E9BC534DE12AB56 (created_by), INDEX IDX_2E9BC5341F6FA0AF (deleted_by), INDEX IDX_2E9BC53416FE72E1 (updated_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, coordination_id INT DEFAULT NULL, created_by INT DEFAULT NULL, deleted_by INT DEFAULT NULL, updated_by INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, lieu_naissance VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, contact_cas_urgent VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, qualite VARCHAR(255) DEFAULT NULL, niveau VARCHAR(255) DEFAULT NULL, ville_actuelle VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_F6B4FB299473E195 (coordination_id), INDEX IDX_F6B4FB29DE12AB56 (created_by), INDEX IDX_F6B4FB291F6FA0AF (deleted_by), INDEX IDX_F6B4FB2916FE72E1 (updated_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, is_root TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6381F6FA0AF FOREIGN KEY (deleted_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63816FE72E1 FOREIGN KEY (updated_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE coordination ADD CONSTRAINT FK_2E9BC534DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE coordination ADD CONSTRAINT FK_2E9BC5341F6FA0AF FOREIGN KEY (deleted_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE coordination ADD CONSTRAINT FK_2E9BC53416FE72E1 FOREIGN KEY (updated_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB299473E195 FOREIGN KEY (coordination_id) REFERENCES coordination (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB29DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB291F6FA0AF FOREIGN KEY (deleted_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB2916FE72E1 FOREIGN KEY (updated_by) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638DE12AB56');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6381F6FA0AF');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63816FE72E1');
        $this->addSql('ALTER TABLE coordination DROP FOREIGN KEY FK_2E9BC534DE12AB56');
        $this->addSql('ALTER TABLE coordination DROP FOREIGN KEY FK_2E9BC5341F6FA0AF');
        $this->addSql('ALTER TABLE coordination DROP FOREIGN KEY FK_2E9BC53416FE72E1');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB299473E195');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB29DE12AB56');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB291F6FA0AF');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB2916FE72E1');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE coordination');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
