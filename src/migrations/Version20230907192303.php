<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230907192303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE charge_record (id INT AUTO_INCREMENT NOT NULL, meter_start INT NOT NULL, timestamp_start DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', meter_stop INT NOT NULL, timestamp_stop DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, rate_id INT DEFAULT NULL, charge_record_id INT DEFAULT NULL, total DOUBLE PRECISION NOT NULL, INDEX IDX_90651744BC999F9F (rate_id), INDEX IDX_90651744245D5F4E (charge_record_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate (id INT AUTO_INCREMENT NOT NULL, energy DOUBLE PRECISION NOT NULL, time DOUBLE PRECISION NOT NULL, transaction DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744BC999F9F FOREIGN KEY (rate_id) REFERENCES rate (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744245D5F4E FOREIGN KEY (charge_record_id) REFERENCES charge_record (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744BC999F9F');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744245D5F4E');
        $this->addSql('DROP TABLE charge_record');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE rate');
    }
}
