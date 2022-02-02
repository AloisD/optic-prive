<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220201164305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'change retail_price and selling_price fields types into decimal from product table and change price field type into decimal from shipping_option table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product CHANGE retail_price retail_price NUMERIC(5, 2) NOT NULL, CHANGE selling_price selling_price NUMERIC(5, 2) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product CHANGE retail_price retail_price INT NOT NULL, CHANGE selling_price selling_price INT NOT NULL');
    }
}
