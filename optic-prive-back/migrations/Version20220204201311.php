<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204201311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add foreign key invoicing_address_id in table order';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD invoicing_address_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939895B927FA FOREIGN KEY (invoicing_address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_F529939895B927FA ON `order` (invoicing_address_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939895B927FA');
        $this->addSql('DROP INDEX IDX_F529939895B927FA ON `order`');
        $this->addSql('ALTER TABLE `order` DROP invoicing_address_id');
    }
}
