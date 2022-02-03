<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220203154041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create foreign keys product_id in table order_has_product and product_image';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_has_product ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_has_product ADD CONSTRAINT FK_AF0913F04584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_AF0913F04584665A ON order_has_product (product_id)');
        $this->addSql('ALTER TABLE product_image ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F034584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_64617F034584665A ON product_image (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_has_product DROP FOREIGN KEY FK_AF0913F04584665A');
        $this->addSql('DROP INDEX IDX_AF0913F04584665A ON order_has_product');
        $this->addSql('ALTER TABLE order_has_product DROP product_id');
        $this->addSql('ALTER TABLE product_image DROP FOREIGN KEY FK_64617F034584665A');
        $this->addSql('DROP INDEX IDX_64617F034584665A ON product_image');
        $this->addSql('ALTER TABLE product_image DROP product_id');
    }
}
