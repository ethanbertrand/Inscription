<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261006140848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annee_anterieur (id INT AUTO_INCREMENT NOT NULL, annee VARCHAR(255) NOT NULL, classe VARCHAR(255) NOT NULL, uneoption VARCHAR(255) DEFAULT NULL, langue1_id INT DEFAULT NULL, langue2_id INT DEFAULT NULL, annee_eleve_id INT DEFAULT NULL, etablissement_id INT DEFAULT NULL, INDEX IDX_EF2CBFFD33933E24 (langue1_id), INDEX IDX_EF2CBFFD212691CA (langue2_id), INDEX IDX_EF2CBFFD21F71D52 (annee_eleve_id), INDEX IDX_EF2CBFFDFF631228 (etablissement_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, num_securite_scoial INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(255) NOT NULL, num_tel INT NOT NULL, mail VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, num_assurance_scolaire VARCHAR(255) NOT NULL, tel_urgence INT NOT NULL, date_vaccin DATE NOT NULL, remarque_sante VARCHAR(255) DEFAULT NULL, num_tel_domicile INT NOT NULL, accepte_sms TINYINT NOT NULL, photo VARCHAR(255) NOT NULL, regime_id INT DEFAULT NULL, assurance_scolaire_id INT DEFAULT NULL, centre_securite_social_id INT DEFAULT NULL, medecin_id INT DEFAULT NULL, m_dl_id INT DEFAULT NULL, classe_id INT DEFAULT NULL, langue_eleve_id INT DEFAULT NULL, parents_eleve_id INT DEFAULT NULL, commune_id INT DEFAULT NULL, a_transport_id INT DEFAULT NULL, INDEX IDX_ECA105F735E7D534 (regime_id), INDEX IDX_ECA105F743AB3277 (assurance_scolaire_id), INDEX IDX_ECA105F73B23DEB0 (centre_securite_social_id), INDEX IDX_ECA105F74F31A84 (medecin_id), INDEX IDX_ECA105F7E97CD6D (m_dl_id), INDEX IDX_ECA105F78F5EA509 (classe_id), INDEX IDX_ECA105F7130B752F (langue_eleve_id), INDEX IDX_ECA105F780864E62 (parents_eleve_id), INDEX IDX_ECA105F7131A4F72 (commune_id), INDEX IDX_ECA105F7C4FF28C (a_transport_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, commune_etablissement_id INT DEFAULT NULL, INDEX IDX_20FD592CAEDC1742 (commune_etablissement_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE langue (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, lv VARCHAR(255) NOT NULL, langue_eleve_id INT DEFAULT NULL, INDEX IDX_9357758E130B752F (langue_eleve_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE langue_eleve (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE mdl (id INT AUTO_INCREMENT NOT NULL, cheque TINYINT NOT NULL, photo TINYINT NOT NULL, affichage TINYINT NOT NULL, adhesion TINYINT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE medecin (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE nationalite (id INT AUTO_INCREMENT NOT NULL, pays VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE nationalite_eleve (id INT AUTO_INCREMENT NOT NULL, nationalite_pays_id INT DEFAULT NULL, eleve_nation_id INT DEFAULT NULL, INDEX IDX_A6C213F146A1AF0 (nationalite_pays_id), INDEX IDX_A6C213F157D2605A (eleve_nation_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE parents (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel_fixe INT NOT NULL, tel_portable INT NOT NULL, tel_entreprise INT NOT NULL, poste VARCHAR(255) NOT NULL, statut_parents_id INT DEFAULT NULL, statut_id INT DEFAULT NULL, parents_eleve_id INT DEFAULT NULL, INDEX IDX_FD501D6AC2CDBBDA (statut_parents_id), INDEX IDX_FD501D6AF6203804 (statut_id), INDEX IDX_FD501D6A80864E62 (parents_eleve_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE parents_eleve (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE regime (id INT AUTO_INCREMENT NOT NULL, regime VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, immatriculation VARCHAR(255) DEFAULT NULL, ligne VARCHAR(255) DEFAULT NULL, a_transport_id INT DEFAULT NULL, type_id INT DEFAULT NULL, INDEX IDX_66AB212EC4FF28C (a_transport_id), INDEX IDX_66AB212EC54C8C93 (type_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE annee_anterieur ADD CONSTRAINT FK_EF2CBFFD33933E24 FOREIGN KEY (langue1_id) REFERENCES langue (id)');
        $this->addSql('ALTER TABLE annee_anterieur ADD CONSTRAINT FK_EF2CBFFD212691CA FOREIGN KEY (langue2_id) REFERENCES langue (id)');
        $this->addSql('ALTER TABLE annee_anterieur ADD CONSTRAINT FK_EF2CBFFD21F71D52 FOREIGN KEY (annee_eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE annee_anterieur ADD CONSTRAINT FK_EF2CBFFDFF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F735E7D534 FOREIGN KEY (regime_id) REFERENCES regime (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F743AB3277 FOREIGN KEY (assurance_scolaire_id) REFERENCES assurance_scolaire (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F73B23DEB0 FOREIGN KEY (centre_securite_social_id) REFERENCES centre_securite_social (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F74F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7E97CD6D FOREIGN KEY (m_dl_id) REFERENCES mdl (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F78F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7130B752F FOREIGN KEY (langue_eleve_id) REFERENCES langue_eleve (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F780864E62 FOREIGN KEY (parents_eleve_id) REFERENCES parents_eleve (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7C4FF28C FOREIGN KEY (a_transport_id) REFERENCES atransport (id)');
        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CAEDC1742 FOREIGN KEY (commune_etablissement_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE langue ADD CONSTRAINT FK_9357758E130B752F FOREIGN KEY (langue_eleve_id) REFERENCES langue_eleve (id)');
        $this->addSql('ALTER TABLE nationalite_eleve ADD CONSTRAINT FK_A6C213F146A1AF0 FOREIGN KEY (nationalite_pays_id) REFERENCES nationalite (id)');
        $this->addSql('ALTER TABLE nationalite_eleve ADD CONSTRAINT FK_A6C213F157D2605A FOREIGN KEY (eleve_nation_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE parents ADD CONSTRAINT FK_FD501D6AC2CDBBDA FOREIGN KEY (statut_parents_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE parents ADD CONSTRAINT FK_FD501D6AF6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE parents ADD CONSTRAINT FK_FD501D6A80864E62 FOREIGN KEY (parents_eleve_id) REFERENCES parents_eleve (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EC4FF28C FOREIGN KEY (a_transport_id) REFERENCES atransport (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annee_anterieur DROP FOREIGN KEY FK_EF2CBFFD33933E24');
        $this->addSql('ALTER TABLE annee_anterieur DROP FOREIGN KEY FK_EF2CBFFD212691CA');
        $this->addSql('ALTER TABLE annee_anterieur DROP FOREIGN KEY FK_EF2CBFFD21F71D52');
        $this->addSql('ALTER TABLE annee_anterieur DROP FOREIGN KEY FK_EF2CBFFDFF631228');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F735E7D534');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F743AB3277');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F73B23DEB0');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F74F31A84');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7E97CD6D');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F78F5EA509');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7130B752F');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F780864E62');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7131A4F72');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7C4FF28C');
        $this->addSql('ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592CAEDC1742');
        $this->addSql('ALTER TABLE langue DROP FOREIGN KEY FK_9357758E130B752F');
        $this->addSql('ALTER TABLE nationalite_eleve DROP FOREIGN KEY FK_A6C213F146A1AF0');
        $this->addSql('ALTER TABLE nationalite_eleve DROP FOREIGN KEY FK_A6C213F157D2605A');
        $this->addSql('ALTER TABLE parents DROP FOREIGN KEY FK_FD501D6AC2CDBBDA');
        $this->addSql('ALTER TABLE parents DROP FOREIGN KEY FK_FD501D6AF6203804');
        $this->addSql('ALTER TABLE parents DROP FOREIGN KEY FK_FD501D6A80864E62');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EC4FF28C');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EC54C8C93');
        $this->addSql('DROP TABLE annee_anterieur');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE langue');
        $this->addSql('DROP TABLE langue_eleve');
        $this->addSql('DROP TABLE mdl');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE nationalite');
        $this->addSql('DROP TABLE nationalite_eleve');
        $this->addSql('DROP TABLE parents');
        $this->addSql('DROP TABLE parents_eleve');
        $this->addSql('DROP TABLE regime');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE transport');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
