<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315160919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE amis (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnages DROP INDEX UNIQ_286738A62CD2A554, ADD INDEX IDX_286738A62CD2A554 (amibff_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnages DROP FOREIGN KEY FK_286738A62CD2A554');
        $this->addSql('DROP TABLE amis');
        $this->addSql('ALTER TABLE personnages DROP INDEX IDX_286738A62CD2A554, ADD UNIQUE INDEX UNIQ_286738A62CD2A554 (amibff_id)');
    }
}
