<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307171805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create table order_has_product';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_has_product (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, order_id INT NOT NULL, quantity INT NOT NULL, order_has_product_status ENUM(\'orderCancelled\', \'orderDelivered\', \'orderInTransit\', \'orderPaymentDue\', \'orderPickupAvailable\', \'orderProblem\', \'orderProcessing\', \'orderReturned\') NOT NULL COMMENT \'(DC2Type:enumOrderStatus)\', rating INT DEFAULT NULL, rating_date DATETIME DEFAULT NULL, payment_info VARCHAR(255) DEFAULT NULL, payment_date DATETIME DEFAULT NULL, shipping_company VARCHAR(255) DEFAULT NULL, tracking_number VARCHAR(255) DEFAULT NULL, price_paid_excl_tax NUMERIC(5, 2) DEFAULT NULL, price_paid__incl_vat NUMERIC(5, 2) DEFAULT NULL, shipping_cost_paid NUMERIC(5, 2) DEFAULT NULL, plateform_fee_paid NUMERIC(5, 2) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_AF0913F04584665A (product_id), INDEX IDX_AF0913F08D9F6D38 (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE order_has_product');
    }
}
