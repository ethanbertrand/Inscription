<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261012124014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annee_anterieur (id INT AUTO_INCREMENT NOT NULL, annee DATE NOT NULL, classe VARCHAR(255) NOT NULL, une_option VARCHAR(255) DEFAULT NULL, annee_eleve_id INT DEFAULT NULL, langue_id INT DEFAULT NULL, INDEX IDX_EF2CBFFD21F71D52 (annee_eleve_id), INDEX IDX_EF2CBFFD2AADBACD (langue_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE assurance_scolaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE atransport (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE commune (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, departement_id INT DEFAULT NULL, INDEX IDX_E2E2D1EECCF9E01E (departement_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, num_securite_social VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, date_naissance DATE DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, num_tel INT DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, sexe VARCHAR(255) DEFAULT NULL, num_assurance_scolaire VARCHAR(255) DEFAULT NULL, tel_urgence INT DEFAULT NULL, date_vaccin DATE DEFAULT NULL, remarque_sante VARCHAR(255) DEFAULT NULL, num_tel_domicile INT DEFAULT NULL, accepte_sms TINYINT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, classe_eleve_id INT DEFAULT NULL, medecin_eleve_id INT DEFAULT NULL, mdl_eleve_id INT DEFAULT NULL, commune_eleve_id INT DEFAULT NULL, annee_anterieur_eleve_id INT DEFAULT NULL, secu_eleve_id INT DEFAULT NULL, assurance_scolaire_id INT DEFAULT NULL, regime_eleve_id INT DEFAULT NULL, transport_eleve_id INT DEFAULT NULL, INDEX IDX_ECA105F730A20F1C (classe_eleve_id), INDEX IDX_ECA105F7527AA266 (medecin_eleve_id), INDEX IDX_ECA105F7245B3CB1 (mdl_eleve_id), INDEX IDX_ECA105F7D35CA39E (commune_eleve_id), INDEX IDX_ECA105F7A3CC98AB (annee_anterieur_eleve_id), INDEX IDX_ECA105F7A3486549 (secu_eleve_id), INDEX IDX_ECA105F743AB3277 (assurance_scolaire_id), INDEX IDX_ECA105F7D9278176 (regime_eleve_id), INDEX IDX_ECA105F7C042D2F8 (transport_eleve_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE eleve_les_parent (eleve_id INT NOT NULL, les_parent_id INT NOT NULL, INDEX IDX_479169F0A6CC7B2 (eleve_id), INDEX IDX_479169F0906009D6 (les_parent_id), PRIMARY KEY (eleve_id, les_parent_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE eleve_langue (eleve_id INT NOT NULL, langue_id INT NOT NULL, INDEX IDX_4A9E4F4FA6CC7B2 (eleve_id), INDEX IDX_4A9E4F4F2AADBACD (langue_id), PRIMARY KEY (eleve_id, langue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, etablissement_commune_id INT DEFAULT NULL, INDEX IDX_20FD592C27194903 (etablissement_commune_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE langue (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, lv VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE les_parent (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel_portable INT NOT NULL, tel_fixe INT NOT NULL, tel_entreprise INT NOT NULL, poste VARCHAR(255) NOT NULL, statut_parent_id INT DEFAULT NULL, INDEX IDX_45AB86A2D3D45FB2 (statut_parent_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE mdl (id INT AUTO_INCREMENT NOT NULL, cheque VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, adhesion TINYINT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE medecin (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE nationalite (id INT AUTO_INCREMENT NOT NULL, pays VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE regime (id INT AUTO_INCREMENT NOT NULL, regime VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE securite_social (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, ligne VARCHAR(255) NOT NULL, immatriculation VARCHAR(255) NOT NULL, type_transport_id INT DEFAULT NULL, auntransport_id INT DEFAULT NULL, INDEX IDX_66AB212E1E4A7B3A (type_transport_id), INDEX IDX_66AB212E5413917A (auntransport_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE type_transport (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE annee_anterieur ADD CONSTRAINT FK_EF2CBFFD21F71D52 FOREIGN KEY (annee_eleve_id) REFERENCES etablissement (id)');
        $this->addSql('ALTER TABLE annee_anterieur ADD CONSTRAINT FK_EF2CBFFD2AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id)');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EECCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F730A20F1C FOREIGN KEY (classe_eleve_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7527AA266 FOREIGN KEY (medecin_eleve_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7245B3CB1 FOREIGN KEY (mdl_eleve_id) REFERENCES mdl (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7D35CA39E FOREIGN KEY (commune_eleve_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7A3CC98AB FOREIGN KEY (annee_anterieur_eleve_id) REFERENCES annee_anterieur (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7A3486549 FOREIGN KEY (secu_eleve_id) REFERENCES securite_social (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F743AB3277 FOREIGN KEY (assurance_scolaire_id) REFERENCES assurance_scolaire (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7D9278176 FOREIGN KEY (regime_eleve_id) REFERENCES regime (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7C042D2F8 FOREIGN KEY (transport_eleve_id) REFERENCES atransport (id)');
        $this->addSql('ALTER TABLE eleve_les_parent ADD CONSTRAINT FK_479169F0A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_les_parent ADD CONSTRAINT FK_479169F0906009D6 FOREIGN KEY (les_parent_id) REFERENCES les_parent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_langue ADD CONSTRAINT FK_4A9E4F4FA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_langue ADD CONSTRAINT FK_4A9E4F4F2AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592C27194903 FOREIGN KEY (etablissement_commune_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE les_parent ADD CONSTRAINT FK_45AB86A2D3D45FB2 FOREIGN KEY (statut_parent_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E1E4A7B3A FOREIGN KEY (type_transport_id) REFERENCES type_transport (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E5413917A FOREIGN KEY (auntransport_id) REFERENCES atransport (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annee_anterieur DROP FOREIGN KEY FK_EF2CBFFD21F71D52');
        $this->addSql('ALTER TABLE annee_anterieur DROP FOREIGN KEY FK_EF2CBFFD2AADBACD');
        $this->addSql('ALTER TABLE commune DROP FOREIGN KEY FK_E2E2D1EECCF9E01E');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F730A20F1C');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7527AA266');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7245B3CB1');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7D35CA39E');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7A3CC98AB');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7A3486549');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F743AB3277');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7D9278176');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7C042D2F8');
        $this->addSql('ALTER TABLE eleve_les_parent DROP FOREIGN KEY FK_479169F0A6CC7B2');
        $this->addSql('ALTER TABLE eleve_les_parent DROP FOREIGN KEY FK_479169F0906009D6');
        $this->addSql('ALTER TABLE eleve_langue DROP FOREIGN KEY FK_4A9E4F4FA6CC7B2');
        $this->addSql('ALTER TABLE eleve_langue DROP FOREIGN KEY FK_4A9E4F4F2AADBACD');
        $this->addSql('ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592C27194903');
        $this->addSql('ALTER TABLE les_parent DROP FOREIGN KEY FK_45AB86A2D3D45FB2');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E1E4A7B3A');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E5413917A');
        $this->addSql('DROP TABLE annee_anterieur');
        $this->addSql('DROP TABLE assurance_scolaire');
        $this->addSql('DROP TABLE atransport');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE eleve_les_parent');
        $this->addSql('DROP TABLE eleve_langue');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE langue');
        $this->addSql('DROP TABLE les_parent');
        $this->addSql('DROP TABLE mdl');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE nationalite');
        $this->addSql('DROP TABLE regime');
        $this->addSql('DROP TABLE securite_social');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE transport');
        $this->addSql('DROP TABLE type_transport');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
