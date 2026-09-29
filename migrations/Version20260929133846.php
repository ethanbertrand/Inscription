<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260929133846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assurance_scolaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE centre_securite_social (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE commune (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE mdl (id INT AUTO_INCREMENT NOT NULL, cheque TINYINT NOT NULL, photo TINYINT NOT NULL, affichage TINYINT NOT NULL, adhesion TINYINT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE medecin (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE nationalite (id INT AUTO_INCREMENT NOT NULL, pays VARCHAR(255) NOT NULL, nationalite_eleve_id INT DEFAULT NULL, INDEX IDX_9EC4D73FC6C23E7F (nationalite_eleve_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE nationalite_eleve (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nationalite ADD CONSTRAINT FK_9EC4D73FC6C23E7F FOREIGN KEY (nationalite_eleve_id) REFERENCES nationalite_eleve (id)');
        $this->addSql('ALTER TABLE eleve ADD assurance_scolaire_id INT DEFAULT NULL, ADD centre_securite_social_id INT DEFAULT NULL, ADD medecin_id INT DEFAULT NULL, ADD m_dl_id INT DEFAULT NULL, ADD classe_id INT DEFAULT NULL, ADD commune_id INT DEFAULT NULL, ADD nationalite_id INT NOT NULL, ADD nationalite_eleve_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F743AB3277 FOREIGN KEY (assurance_scolaire_id) REFERENCES assurance_scolaire (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F73B23DEB0 FOREIGN KEY (centre_securite_social_id) REFERENCES centre_securite_social (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F74F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7E97CD6D FOREIGN KEY (m_dl_id) REFERENCES mdl (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F78F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F71B063272 FOREIGN KEY (nationalite_id) REFERENCES nationalite (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7C6C23E7F FOREIGN KEY (nationalite_eleve_id) REFERENCES nationalite_eleve (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F743AB3277 ON eleve (assurance_scolaire_id)');
        $this->addSql('CREATE INDEX IDX_ECA105F73B23DEB0 ON eleve (centre_securite_social_id)');
        $this->addSql('CREATE INDEX IDX_ECA105F74F31A84 ON eleve (medecin_id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7E97CD6D ON eleve (m_dl_id)');
        $this->addSql('CREATE INDEX IDX_ECA105F78F5EA509 ON eleve (classe_id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7131A4F72 ON eleve (commune_id)');
        $this->addSql('CREATE INDEX IDX_ECA105F71B063272 ON eleve (nationalite_id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7C6C23E7F ON eleve (nationalite_eleve_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nationalite DROP FOREIGN KEY FK_9EC4D73FC6C23E7F');
        $this->addSql('DROP TABLE assurance_scolaire');
        $this->addSql('DROP TABLE centre_securite_social');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE mdl');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE nationalite');
        $this->addSql('DROP TABLE nationalite_eleve');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F743AB3277');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F73B23DEB0');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F74F31A84');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7E97CD6D');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F78F5EA509');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7131A4F72');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F71B063272');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7C6C23E7F');
        $this->addSql('DROP INDEX IDX_ECA105F743AB3277 ON eleve');
        $this->addSql('DROP INDEX IDX_ECA105F73B23DEB0 ON eleve');
        $this->addSql('DROP INDEX IDX_ECA105F74F31A84 ON eleve');
        $this->addSql('DROP INDEX IDX_ECA105F7E97CD6D ON eleve');
        $this->addSql('DROP INDEX IDX_ECA105F78F5EA509 ON eleve');
        $this->addSql('DROP INDEX IDX_ECA105F7131A4F72 ON eleve');
        $this->addSql('DROP INDEX IDX_ECA105F71B063272 ON eleve');
        $this->addSql('DROP INDEX IDX_ECA105F7C6C23E7F ON eleve');
        $this->addSql('ALTER TABLE eleve DROP assurance_scolaire_id, DROP centre_securite_social_id, DROP medecin_id, DROP m_dl_id, DROP classe_id, DROP commune_id, DROP nationalite_id, DROP nationalite_eleve_id');
    }
}
