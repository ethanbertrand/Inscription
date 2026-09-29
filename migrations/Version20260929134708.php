<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260929134708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annee_anterieur (id INT AUTO_INCREMENT NOT NULL, annee VARCHAR(255) NOT NULL, classe VARCHAR(255) NOT NULL, uneoption VARCHAR(255) DEFAULT NULL, langue1_id INT DEFAULT NULL, langue2_id INT DEFAULT NULL, annee_eleve_id INT DEFAULT NULL, INDEX IDX_EF2CBFFD33933E24 (langue1_id), INDEX IDX_EF2CBFFD212691CA (langue2_id), INDEX IDX_EF2CBFFD21F71D52 (annee_eleve_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE langue (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, lv VARCHAR(255) NOT NULL, langue_eleve_id INT DEFAULT NULL, INDEX IDX_9357758E130B752F (langue_eleve_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE langue_eleve (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE annee_anterieur ADD CONSTRAINT FK_EF2CBFFD33933E24 FOREIGN KEY (langue1_id) REFERENCES langue (id)');
        $this->addSql('ALTER TABLE annee_anterieur ADD CONSTRAINT FK_EF2CBFFD212691CA FOREIGN KEY (langue2_id) REFERENCES langue (id)');
        $this->addSql('ALTER TABLE annee_anterieur ADD CONSTRAINT FK_EF2CBFFD21F71D52 FOREIGN KEY (annee_eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE langue ADD CONSTRAINT FK_9357758E130B752F FOREIGN KEY (langue_eleve_id) REFERENCES langue_eleve (id)');
        $this->addSql('ALTER TABLE eleve ADD langue_eleve_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7130B752F FOREIGN KEY (langue_eleve_id) REFERENCES langue_eleve (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7130B752F ON eleve (langue_eleve_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annee_anterieur DROP FOREIGN KEY FK_EF2CBFFD33933E24');
        $this->addSql('ALTER TABLE annee_anterieur DROP FOREIGN KEY FK_EF2CBFFD212691CA');
        $this->addSql('ALTER TABLE annee_anterieur DROP FOREIGN KEY FK_EF2CBFFD21F71D52');
        $this->addSql('ALTER TABLE langue DROP FOREIGN KEY FK_9357758E130B752F');
        $this->addSql('DROP TABLE annee_anterieur');
        $this->addSql('DROP TABLE langue');
        $this->addSql('DROP TABLE langue_eleve');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7130B752F');
        $this->addSql('DROP INDEX IDX_ECA105F7130B752F ON eleve');
        $this->addSql('ALTER TABLE eleve DROP langue_eleve_id');
    }
}
