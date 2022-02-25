<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220225114542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create table business_user and add foreign key user_id';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE business_user (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, country VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, street VARCHAR(255) DEFAULT NULL, number INT DEFAULT NULL, company VARCHAR(255) NOT NULL, additional_details LONGTEXT DEFAULT NULL, siren VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, platform_fee_rate INT NOT NULL, discounted_fee INT DEFAULT NULL, discount_validity_end DATETIME DEFAULT NULL, INDEX IDX_DD08D444A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE business_user ADD CONSTRAINT FK_DD08D444A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE business_user');
    }
}
