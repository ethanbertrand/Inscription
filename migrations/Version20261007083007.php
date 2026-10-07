<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261007083007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve CHANGE num_securite_scoial num_securite_scoial INT DEFAULT NULL, CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE date_naissance date_naissance DATE DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE num_tel num_tel INT DEFAULT NULL, CHANGE mail mail VARCHAR(255) DEFAULT NULL, CHANGE sexe sexe VARCHAR(255) DEFAULT NULL, CHANGE num_assurance_scolaire num_assurance_scolaire VARCHAR(255) DEFAULT NULL, CHANGE tel_urgence tel_urgence INT DEFAULT NULL, CHANGE date_vaccin date_vaccin DATE DEFAULT NULL, CHANGE num_tel_domicile num_tel_domicile INT DEFAULT NULL, CHANGE accepte_sms accepte_sms TINYINT DEFAULT NULL, CHANGE photo photo VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve CHANGE num_securite_scoial num_securite_scoial INT NOT NULL, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE date_naissance date_naissance DATE NOT NULL, CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE num_tel num_tel INT NOT NULL, CHANGE mail mail VARCHAR(255) NOT NULL, CHANGE sexe sexe VARCHAR(255) NOT NULL, CHANGE num_assurance_scolaire num_assurance_scolaire VARCHAR(255) NOT NULL, CHANGE tel_urgence tel_urgence INT NOT NULL, CHANGE date_vaccin date_vaccin DATE NOT NULL, CHANGE num_tel_domicile num_tel_domicile INT NOT NULL, CHANGE accepte_sms accepte_sms TINYINT NOT NULL, CHANGE photo photo VARCHAR(255) NOT NULL');
    }
}
