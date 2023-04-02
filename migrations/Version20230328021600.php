<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328021600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY fk_commandes_vehicules');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY fk_commandes_users');
        $this->addSql('ALTER TABLE maintenances DROP FOREIGN KEY fk_maintenances_users');
        $this->addSql('ALTER TABLE maintenances DROP FOREIGN KEY fk_maintenances_vehicules');
        $this->addSql('ALTER TABLE modeles DROP FOREIGN KEY fk_modeles_categories');
        $this->addSql('ALTER TABLE paiements DROP FOREIGN KEY fk_paiements_commandes');
        $this->addSql('ALTER TABLE paiements DROP FOREIGN KEY fk_paiements_users');
        $this->addSql('ALTER TABLE rapports DROP FOREIGN KEY fk_rapports_users');
        $this->addSql('ALTER TABLE reclamations DROP FOREIGN KEY fk_reclamations_users');
        $this->addSql('ALTER TABLE vehicules DROP FOREIGN KEY FK_vehicules_modeles');
        $this->addSql('DROP TABLE abonnements');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE conventions');
        $this->addSql('DROP TABLE evenements');
        $this->addSql('DROP TABLE maintenances');
        $this->addSql('DROP TABLE modeles');
        $this->addSql('DROP TABLE paiements');
        $this->addSql('DROP TABLE participations');
        $this->addSql('DROP TABLE rapports');
        $this->addSql('DROP TABLE ratings');
        $this->addSql('DROP TABLE reclamations');
        $this->addSql('DROP TABLE utilisateurs');
        $this->addSql('DROP TABLE vehicules');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnements (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prix INT NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, archive INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, utilisationRecommendee VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, archivee TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, idClient INT DEFAULT NULL, date DATE DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idVehicule INT DEFAULT NULL, archivee TINYINT(1) NOT NULL, INDEX fk_commandes_users (idClient), INDEX fk_commandes_vehicules (idVehicule), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE conventions (id INT AUTO_INCREMENT NOT NULL, nbAbonnement INT NOT NULL, prix DOUBLE PRECISION NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, archive INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE evenements (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, dateDebut DATE DEFAULT NULL, dateFin DATE DEFAULT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, adresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, archive INT DEFAULT 1 NOT NULL, date DATE DEFAULT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, remise INT DEFAULT NULL, chemin VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, heure TIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE maintenances (id INT AUTO_INCREMENT NOT NULL, date DATE DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idVehicule INT DEFAULT NULL, idTechnicien INT DEFAULT NULL, status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, archive TINYINT(1) NOT NULL, INDEX fk_maintenances_vehicules (idVehicule), INDEX fk_maintenances_users (idTechnicien), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE modeles (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idCategorie INT DEFAULT NULL, marque VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, puissance INT NOT NULL, prix DOUBLE PRECISION NOT NULL, archivee TINYINT(1) NOT NULL, ImgSRC VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX fk_modeles_categories (idCategorie), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE paiements (id INT AUTO_INCREMENT NOT NULL, idCommande INT DEFAULT NULL, idClient INT DEFAULT NULL, date DATE DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL, mode VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, montant DOUBLE PRECISION NOT NULL, archivee TINYINT(1) NOT NULL, INDEX fk_paiements_commandes (idCommande), INDEX fk_paiements_users (idClient), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE participations (id INT AUTO_INCREMENT NOT NULL, id_evenement INT NOT NULL, id_utilisateur INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rapports (id INT AUTO_INCREMENT NOT NULL, cout DOUBLE PRECISION NOT NULL, piecesChangees VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, tachesRealisees VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idTechnicien INT DEFAULT NULL, archive TINYINT(1) NOT NULL, idMaintenance INT NOT NULL, INDEX fk_rapports_users (idTechnicien), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ratings (id INT AUTO_INCREMENT NOT NULL, idUtilisateur INT NOT NULL, idEvenement INT NOT NULL, rate INT NOT NULL, INDEX fk_utilisateur (idUtilisateur), INDEX fk_evenement (idEvenement), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reclamations (id INT AUTO_INCREMENT NOT NULL, idClient INT DEFAULT NULL, idVehicule INT NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date DATE DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, archive TINYINT(1) NOT NULL, INDEX fk_reclamations_users (idClient), INDEX fk_reclamations_vehicules (idVehicule), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, cin INT NOT NULL, mdp VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, numTelephone INT NOT NULL, dateNaissance DATE NOT NULL, genre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, createdDate DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, role VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, active TINYINT(1) NOT NULL, adresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, ville VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, pays VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, numLicense INT DEFAULT NULL, dateLicense DATE DEFAULT NULL, competences VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, disponibilite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, secteur VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, idAbonnement INT DEFAULT NULL, idConvention INT DEFAULT NULL, UNIQUE INDEX createdDate (createdDate), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vehicules (id INT AUTO_INCREMENT NOT NULL, idModele INT DEFAULT NULL, matricule VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, couleur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, kilometrage INT NOT NULL, archivee TINYINT(1) NOT NULL, UNIQUE INDEX matricule (matricule), INDEX FK_vehicules_modeles (idModele), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT fk_commandes_vehicules FOREIGN KEY (idVehicule) REFERENCES vehicules (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT fk_commandes_users FOREIGN KEY (idClient) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE maintenances ADD CONSTRAINT fk_maintenances_users FOREIGN KEY (idTechnicien) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE maintenances ADD CONSTRAINT fk_maintenances_vehicules FOREIGN KEY (idVehicule) REFERENCES vehicules (id)');
        $this->addSql('ALTER TABLE modeles ADD CONSTRAINT fk_modeles_categories FOREIGN KEY (idCategorie) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE paiements ADD CONSTRAINT fk_paiements_commandes FOREIGN KEY (idCommande) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE paiements ADD CONSTRAINT fk_paiements_users FOREIGN KEY (idClient) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE rapports ADD CONSTRAINT fk_rapports_users FOREIGN KEY (idTechnicien) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE reclamations ADD CONSTRAINT fk_reclamations_users FOREIGN KEY (idClient) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE vehicules ADD CONSTRAINT FK_vehicules_modeles FOREIGN KEY (idModele) REFERENCES modeles (id)');
        $this->addSql('DROP TABLE commande');
    }
}
