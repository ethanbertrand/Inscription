<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261013144716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commune ADD code_insee VARCHAR(5) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E2E2D1EE1649A761 ON commune (code_insee)');
        $this->addSql('ALTER TABLE departement ADD code VARCHAR(3) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C1765B6377153098 ON departement (code)');
        $this->addSql('ALTER TABLE eleve MODIFY accepte_sms BOOLEAN DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_E2E2D1EE1649A761 ON commune');
        $this->addSql('ALTER TABLE commune DROP code_insee');
        $this->addSql('DROP INDEX UNIQ_C1765B6377153098 ON departement');
        $this->addSql('ALTER TABLE departement DROP code');
        $this->addSql('ALTER TABLE eleve MODIFY accepte_sms BOOLEAN DEFAULT NULL;');
    }
}
