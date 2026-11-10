<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261103173500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add transport details to eleve';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE eleve ADD transport TINYINT(1) DEFAULT NULL, ADD type_transport VARCHAR(30) DEFAULT NULL, ADD immatriculation VARCHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE eleve DROP transport, DROP type_transport, DROP immatriculation');
    }
}
