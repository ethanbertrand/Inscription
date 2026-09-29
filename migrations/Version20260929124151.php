<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260929124151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, num_securite_scoial INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(255) NOT NULL, num_tel INT NOT NULL, mail VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, num_assurance_scolaire VARCHAR(255) NOT NULL, tel_urgence INT NOT NULL, date_vaccin DATE NOT NULL, remarque_sante VARCHAR(255) DEFAULT NULL, num_tel_domicile INT NOT NULL, accepte_sms TINYINT NOT NULL, photo VARCHAR(255) NOT NULL, regime_id INT DEFAULT NULL, INDEX IDX_ECA105F735E7D534 (regime_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE regime (id INT AUTO_INCREMENT NOT NULL, regime VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F735E7D534 FOREIGN KEY (regime_id) REFERENCES regime (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F735E7D534');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE regime');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
