<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261110143713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE langue_eleve (id INT AUTO_INCREMENT NOT NULL, lv SMALLINT NOT NULL, eleve_id INT NOT NULL, langue_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_DA9EC2CEA6CC7B22AADBACD (eleve_id, langue_id), INDEX IDX_DA9EC2CEA6CC7B2 (eleve_id), INDEX IDX_DA9EC2CE2AADBACD (langue_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE langue_eleve ADD CONSTRAINT FK_DA9EC2CEA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE langue_eleve ADD CONSTRAINT FK_DA9EC2CE2AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id)');
        $this->addSql('ALTER TABLE eleve_langue DROP FOREIGN KEY `FK_4A9E4F4F2AADBACD`');
        $this->addSql('ALTER TABLE eleve_langue DROP FOREIGN KEY `FK_4A9E4F4FA6CC7B2`');
        $this->addSql('DROP TABLE eleve_langue');
        $this->addSql('ALTER TABLE langue ADD lv VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE eleve_langue (eleve_id INT NOT NULL, langue_id INT NOT NULL, lv INT DEFAULT NULL, INDEX IDX_4A9E4F4FA6CC7B2 (eleve_id), INDEX IDX_4A9E4F4F2AADBACD (langue_id), PRIMARY KEY (eleve_id, langue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE eleve_langue ADD CONSTRAINT `FK_4A9E4F4F2AADBACD` FOREIGN KEY (langue_id) REFERENCES langue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_langue ADD CONSTRAINT `FK_4A9E4F4FA6CC7B2` FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE langue_eleve DROP FOREIGN KEY FK_DA9EC2CEA6CC7B2');
        $this->addSql('ALTER TABLE langue_eleve DROP FOREIGN KEY FK_DA9EC2CE2AADBACD');
        $this->addSql('DROP TABLE langue_eleve');
        $this->addSql('ALTER TABLE langue DROP lv');
    }
}
