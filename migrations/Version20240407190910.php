<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240407190910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, cours_id INT DEFAULT NULL, devise_id INT DEFAULT NULL, client_id INT DEFAULT NULL, date_achat DATETIME DEFAULT NULL, montant_achat DOUBLE PRECISION NULL, montant_conversion DOUBLE PRECISION NULL, INDEX IDX_26A984567ECF78B0 (cours_id), INDEX IDX_26A98456F4445056 (devise_id), INDEX IDX_26A9845619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A984567ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A98456F4445056 FOREIGN KEY (devise_id) REFERENCES devise (id)');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A984567ECF78B0');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A98456F4445056');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845619EB6921');
        $this->addSql('DROP TABLE achat');
    }
}
