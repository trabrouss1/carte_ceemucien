<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240415150727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact ADD created_by INT DEFAULT NULL, ADD deleted_by INT DEFAULT NULL, ADD updated_by INT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD deleted_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6381F6FA0AF FOREIGN KEY (deleted_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63816FE72E1 FOREIGN KEY (updated_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4C62E638DE12AB56 ON contact (created_by)');
        $this->addSql('CREATE INDEX IDX_4C62E6381F6FA0AF ON contact (deleted_by)');
        $this->addSql('CREATE INDEX IDX_4C62E63816FE72E1 ON contact (updated_by)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL, CHANGE available_at available_at DATETIME NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638DE12AB56');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6381F6FA0AF');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63816FE72E1');
        $this->addSql('DROP INDEX IDX_4C62E638DE12AB56 ON contact');
        $this->addSql('DROP INDEX IDX_4C62E6381F6FA0AF ON contact');
        $this->addSql('DROP INDEX IDX_4C62E63816FE72E1 ON contact');
        $this->addSql('ALTER TABLE contact DROP created_by, DROP deleted_by, DROP updated_by, DROP created_at, DROP deleted_at, DROP updated_at');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL, CHANGE available_at available_at DATETIME NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}
