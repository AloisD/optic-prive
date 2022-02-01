<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220201102359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Added item_availability field into product table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD item_availability ENUM(\'backOrder\', \'discontinued\', \'inStock\', \'inStoreOnly\', \'limitedAvailability\', \'onlineOnly\', \'outOfStock\', \'preOrder\', \'preSale\', \'soldOut\') NOT NULL COMMENT \'(DC2Type:enumItemAvailability)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP item_availability');
    }
}
