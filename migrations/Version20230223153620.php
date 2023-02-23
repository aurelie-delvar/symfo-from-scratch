<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223153620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE personnages_qualidad (personnages_id INT NOT NULL, qualidad_id INT NOT NULL, INDEX IDX_5193D0747FFDACCA (personnages_id), INDEX IDX_5193D0748C4A34E1 (qualidad_id), PRIMARY KEY(personnages_id, qualidad_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qualidad (id INT AUTO_INCREMENT NOT NULL, adjectif VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnages_qualidad ADD CONSTRAINT FK_5193D0747FFDACCA FOREIGN KEY (personnages_id) REFERENCES personnages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnages_qualidad ADD CONSTRAINT FK_5193D0748C4A34E1 FOREIGN KEY (qualidad_id) REFERENCES qualidad (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnages_qualidad DROP FOREIGN KEY FK_5193D0747FFDACCA');
        $this->addSql('ALTER TABLE personnages_qualidad DROP FOREIGN KEY FK_5193D0748C4A34E1');
        $this->addSql('DROP TABLE personnages_qualidad');
        $this->addSql('DROP TABLE qualidad');
    }
}
