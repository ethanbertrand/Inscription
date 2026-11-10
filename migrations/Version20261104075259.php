<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261104075259 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP transport, DROP type_transport, DROP immatriculation');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY `FK_66AB212E5413917A`');
        $this->addSql('DROP INDEX IDX_66AB212E5413917A ON transport');
        $this->addSql('ALTER TABLE transport CHANGE auntransport_id eleve_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('CREATE INDEX IDX_66AB212EA6CC7B2 ON transport (eleve_id)');
        $this->addSql('ALTER TABLE langue DROP COLUMN lv;');
        $this->addSql('ALTER TABLE eleve_langue ADD COLUMN lv int;');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve ADD transport TINYINT DEFAULT NULL, ADD type_transport VARCHAR(30) DEFAULT NULL, ADD immatriculation VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EA6CC7B2');
        $this->addSql('DROP INDEX IDX_66AB212EA6CC7B2 ON transport');
        $this->addSql('ALTER TABLE transport CHANGE eleve_id auntransport_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT `FK_66AB212E5413917A` FOREIGN KEY (auntransport_id) REFERENCES atransport (id)');
        $this->addSql('CREATE INDEX IDX_66AB212E5413917A ON transport (auntransport_id)');
        $this->addSql('ALTER TABLE langue DROP COLUMN lv;');
        $this->addSql('ALTER TABLE eleve_langue DROP COLUMN lv;');
    }
}
