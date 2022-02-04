<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204205559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add foreign key shipping_id in table order';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD shipping_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993984887F3F8 FOREIGN KEY (shipping_id) REFERENCES shipping_option (id)');
        $this->addSql('CREATE INDEX IDX_F52993984887F3F8 ON `order` (shipping_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993984887F3F8');
        $this->addSql('DROP INDEX IDX_F52993984887F3F8 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP shipping_id');
    }
}
