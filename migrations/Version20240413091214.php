<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240413091214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, date_vente DATETIME DEFAULT NULL, montant_vente DOUBLE PRECISION DEFAULT NULL, montant_conversion DOUBLE PRECISION DEFAULT NULL, INDEX IDX_888A2A4C19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE achat CHANGE montant_achat montant_achat DOUBLE PRECISION NOT NULL, CHANGE montant_conversion montant_conversion DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4C19EB6921');
        $this->addSql('DROP TABLE vente');
        $this->addSql('ALTER TABLE achat CHANGE montant_achat montant_achat DOUBLE PRECISION DEFAULT NULL, CHANGE montant_conversion montant_conversion DOUBLE PRECISION DEFAULT NULL');
    }
}
