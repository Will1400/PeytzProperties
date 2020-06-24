<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200624072932 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Apartment ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE Condo ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE villa ADD owner_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Apartment DROP owner_id');
        $this->addSql('ALTER TABLE Condo DROP owner_id');
        $this->addSql('ALTER TABLE villa DROP owner_id');
    }
}
