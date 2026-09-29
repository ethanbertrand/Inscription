<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260929150112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atransport (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, commune_etablissement_id INT DEFAULT NULL, INDEX IDX_20FD592CAEDC1742 (commune_etablissement_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE parents (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel_fixe INT NOT NULL, tel_portable INT NOT NULL, tel_entreprise INT NOT NULL, poste VARCHAR(255) NOT NULL, statut_parents_id INT DEFAULT NULL, statut_id INT DEFAULT NULL, parents_eleve_id INT DEFAULT NULL, INDEX IDX_FD501D6AC2CDBBDA (statut_parents_id), INDEX IDX_FD501D6AF6203804 (statut_id), INDEX IDX_FD501D6A80864E62 (parents_eleve_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE parents_eleve (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, immatriculation VARCHAR(255) DEFAULT NULL, ligne VARCHAR(255) DEFAULT NULL, a_transport_id INT DEFAULT NULL, type_id INT DEFAULT NULL, INDEX IDX_66AB212EC4FF28C (a_transport_id), INDEX IDX_66AB212EC54C8C93 (type_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CAEDC1742 FOREIGN KEY (commune_etablissement_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE parents ADD CONSTRAINT FK_FD501D6AC2CDBBDA FOREIGN KEY (statut_parents_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE parents ADD CONSTRAINT FK_FD501D6AF6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE parents ADD CONSTRAINT FK_FD501D6A80864E62 FOREIGN KEY (parents_eleve_id) REFERENCES parents_eleve (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EC4FF28C FOREIGN KEY (a_transport_id) REFERENCES atransport (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE annee_anterieur ADD etablissement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annee_anterieur ADD CONSTRAINT FK_EF2CBFFDFF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
        $this->addSql('CREATE INDEX IDX_EF2CBFFDFF631228 ON annee_anterieur (etablissement_id)');
        $this->addSql('ALTER TABLE commune ADD departement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EECCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('CREATE INDEX IDX_E2E2D1EECCF9E01E ON commune (departement_id)');
        $this->addSql('ALTER TABLE eleve ADD parents_eleve_id INT DEFAULT NULL, ADD a_transport_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F780864E62 FOREIGN KEY (parents_eleve_id) REFERENCES parents_eleve (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7C4FF28C FOREIGN KEY (a_transport_id) REFERENCES atransport (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F780864E62 ON eleve (parents_eleve_id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7C4FF28C ON eleve (a_transport_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592CAEDC1742');
        $this->addSql('ALTER TABLE parents DROP FOREIGN KEY FK_FD501D6AC2CDBBDA');
        $this->addSql('ALTER TABLE parents DROP FOREIGN KEY FK_FD501D6AF6203804');
        $this->addSql('ALTER TABLE parents DROP FOREIGN KEY FK_FD501D6A80864E62');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EC4FF28C');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EC54C8C93');
        $this->addSql('DROP TABLE atransport');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE parents');
        $this->addSql('DROP TABLE parents_eleve');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE transport');
        $this->addSql('DROP TABLE type');
        $this->addSql('ALTER TABLE annee_anterieur DROP FOREIGN KEY FK_EF2CBFFDFF631228');
        $this->addSql('DROP INDEX IDX_EF2CBFFDFF631228 ON annee_anterieur');
        $this->addSql('ALTER TABLE annee_anterieur DROP etablissement_id');
        $this->addSql('ALTER TABLE commune DROP FOREIGN KEY FK_E2E2D1EECCF9E01E');
        $this->addSql('DROP INDEX IDX_E2E2D1EECCF9E01E ON commune');
        $this->addSql('ALTER TABLE commune DROP departement_id');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F780864E62');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7C4FF28C');
        $this->addSql('DROP INDEX IDX_ECA105F780864E62 ON eleve');
        $this->addSql('DROP INDEX IDX_ECA105F7C4FF28C ON eleve');
        $this->addSql('ALTER TABLE eleve DROP parents_eleve_id, DROP a_transport_id');
    }
}
