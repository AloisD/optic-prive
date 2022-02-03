<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220203162942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create foreign keys invoicing_addess and delivery_address in table order';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD invoicing_adress_id INT NOT NULL, ADD delivery_address_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993983A80A333 FOREIGN KEY (invoicing_adress_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398EBF23851 FOREIGN KEY (delivery_address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_F52993983A80A333 ON `order` (invoicing_adress_id)');
        $this->addSql('CREATE INDEX IDX_F5299398EBF23851 ON `order` (delivery_address_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993983A80A333');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398EBF23851');
        $this->addSql('DROP INDEX IDX_F52993983A80A333 ON `order`');
        $this->addSql('DROP INDEX IDX_F5299398EBF23851 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP invoicing_adress_id, DROP delivery_address_id');
    }
}
