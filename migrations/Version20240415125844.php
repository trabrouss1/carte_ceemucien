<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240415125844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, is_root TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coordination ADD created_by INT DEFAULT NULL, ADD deleted_by INT DEFAULT NULL, ADD updated_by INT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD deleted_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE coordination ADD CONSTRAINT FK_2E9BC534DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE coordination ADD CONSTRAINT FK_2E9BC5341F6FA0AF FOREIGN KEY (deleted_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE coordination ADD CONSTRAINT FK_2E9BC53416FE72E1 FOREIGN KEY (updated_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2E9BC534DE12AB56 ON coordination (created_by)');
        $this->addSql('CREATE INDEX IDX_2E9BC5341F6FA0AF ON coordination (deleted_by)');
        $this->addSql('CREATE INDEX IDX_2E9BC53416FE72E1 ON coordination (updated_by)');
        $this->addSql('ALTER TABLE membre ADD created_by INT DEFAULT NULL, ADD deleted_by INT DEFAULT NULL, ADD updated_by INT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD deleted_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB29DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB291F6FA0AF FOREIGN KEY (deleted_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB2916FE72E1 FOREIGN KEY (updated_by) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F6B4FB29DE12AB56 ON membre (created_by)');
        $this->addSql('CREATE INDEX IDX_F6B4FB291F6FA0AF ON membre (deleted_by)');
        $this->addSql('CREATE INDEX IDX_F6B4FB2916FE72E1 ON membre (updated_by)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL, CHANGE available_at available_at DATETIME NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coordination DROP FOREIGN KEY FK_2E9BC534DE12AB56');
        $this->addSql('ALTER TABLE coordination DROP FOREIGN KEY FK_2E9BC5341F6FA0AF');
        $this->addSql('ALTER TABLE coordination DROP FOREIGN KEY FK_2E9BC53416FE72E1');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB29DE12AB56');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB291F6FA0AF');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB2916FE72E1');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_2E9BC534DE12AB56 ON coordination');
        $this->addSql('DROP INDEX IDX_2E9BC5341F6FA0AF ON coordination');
        $this->addSql('DROP INDEX IDX_2E9BC53416FE72E1 ON coordination');
        $this->addSql('ALTER TABLE coordination DROP created_by, DROP deleted_by, DROP updated_by, DROP created_at, DROP deleted_at, DROP updated_at');
        $this->addSql('DROP INDEX IDX_F6B4FB29DE12AB56 ON membre');
        $this->addSql('DROP INDEX IDX_F6B4FB291F6FA0AF ON membre');
        $this->addSql('DROP INDEX IDX_F6B4FB2916FE72E1 ON membre');
        $this->addSql('ALTER TABLE membre DROP created_by, DROP deleted_by, DROP updated_by, DROP created_at, DROP deleted_at, DROP updated_at');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL, CHANGE available_at available_at DATETIME NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}
