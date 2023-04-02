<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328011147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories CHANGE archivee archivee TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE commandes CHANGE idClient idClient INT DEFAULT NULL, CHANGE idVehicule idVehicule INT DEFAULT NULL, CHANGE archivee archivee TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE maintenances CHANGE idVehicule idVehicule INT DEFAULT NULL, CHANGE idTechnicien idTechnicien INT DEFAULT NULL, CHANGE archive archive TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE modeles CHANGE idCategorie idCategorie INT DEFAULT NULL, CHANGE archivee archivee TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE paiements CHANGE idCommande idCommande INT DEFAULT NULL, CHANGE idClient idClient INT DEFAULT NULL, CHANGE archivee archivee TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE rapports CHANGE idTechnicien idTechnicien INT DEFAULT NULL, CHANGE archive archive TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE reclamations CHANGE idClient idClient INT DEFAULT NULL, CHANGE archive archive TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE vehicules CHANGE idModele idModele INT DEFAULT NULL, CHANGE archivee archivee TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE categories CHANGE archivee archivee TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE commandes CHANGE archivee archivee TINYINT(1) DEFAULT 0 NOT NULL, CHANGE idVehicule idVehicule INT NOT NULL, CHANGE idClient idClient INT NOT NULL');
        $this->addSql('ALTER TABLE maintenances CHANGE archive archive TINYINT(1) DEFAULT 0 NOT NULL, CHANGE idTechnicien idTechnicien INT NOT NULL, CHANGE idVehicule idVehicule INT NOT NULL');
        $this->addSql('ALTER TABLE modeles CHANGE archivee archivee TINYINT(1) DEFAULT 0 NOT NULL, CHANGE idCategorie idCategorie INT NOT NULL');
        $this->addSql('ALTER TABLE paiements CHANGE archivee archivee TINYINT(1) DEFAULT 0 NOT NULL, CHANGE idCommande idCommande INT NOT NULL, CHANGE idClient idClient INT NOT NULL');
        $this->addSql('ALTER TABLE rapports CHANGE archive archive TINYINT(1) DEFAULT 0 NOT NULL, CHANGE idTechnicien idTechnicien INT NOT NULL');
        $this->addSql('ALTER TABLE reclamations CHANGE archive archive TINYINT(1) DEFAULT 0 NOT NULL, CHANGE idClient idClient INT NOT NULL');
        $this->addSql('ALTER TABLE vehicules CHANGE archivee archivee TINYINT(1) DEFAULT 0 NOT NULL, CHANGE idModele idModele INT NOT NULL');
    }
}
