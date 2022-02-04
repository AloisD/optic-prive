<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204173504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add foreign key order_id in table order_has_product';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_has_product ADD order_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_has_product ADD CONSTRAINT FK_AF0913F08D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_AF0913F08D9F6D38 ON order_has_product (order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_has_product DROP FOREIGN KEY FK_AF0913F08D9F6D38');
        $this->addSql('DROP INDEX IDX_AF0913F08D9F6D38 ON order_has_product');
        $this->addSql('ALTER TABLE order_has_product DROP order_id');
    }
}
