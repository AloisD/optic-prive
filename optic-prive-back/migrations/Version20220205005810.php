<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220205005810 extends AbstractMigration
{
  public function getDescription(): string
  {
    return 'Added image_name field into product table';
  }

  public function up(Schema $schema): void
  {
    // this up() migration is auto-generated, please modify it to your needs
    $this->addSql('ALTER TABLE product ADD image_name VARCHAR(255) DEFAULT NULL');
  }

  public function down(Schema $schema): void
  {
    // this down() migration is auto-generated, please modify it to your needs
    $this->addSql('ALTER TABLE address CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE recipient recipient VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE country country VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE street street VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE company company VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE additionnal_details additionnal_details LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    $this->addSql('ALTER TABLE brand CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE logo logo VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    $this->addSql('ALTER TABLE color CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE logo logo VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    $this->addSql('ALTER TABLE lens_type CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    $this->addSql('ALTER TABLE material CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE logo logo VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    $this->addSql('ALTER TABLE `order` CHANGE order_status order_status ENUM(\'orderCancelled\', \'orderDelivered\', \'orderInTransit\', \'orderPaymentDue\', \'orderPickupAvailable\', \'orderProblem\', \'orderProcessing\', \'orderReturned\') NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:enumOrderStatus)\'');
    $this->addSql('ALTER TABLE order_has_product CHANGE order_has_product_status order_has_product_status ENUM(\'orderCancelled\', \'orderDelivered\', \'orderInTransit\', \'orderPaymentDue\', \'orderPickupAvailable\', \'orderProblem\', \'orderProcessing\', \'orderReturned\') NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:enumOrderStatus)\', CHANGE payment_info payment_info VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE shipping_company shipping_company VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tracking_number tracking_number VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    $this->addSql('ALTER TABLE product DROP image_name, CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reference reference VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE color_code color_code VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE state state ENUM(\'damagedCondition\', \'newCondition\', \'refurbishedCondition\', \'usedCondition\') NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:enumState)\', CHANGE category category ENUM(\'male\', \'female\', \'child\', \'unisex\') NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:enumCategory)\', CHANGE uv_protection uv_protection ENUM(\'category0\', \'category1\', \'category2\', \'category3\', \'category4\') DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:enumUvProtection)\', CHANGE item_availability item_availability ENUM(\'backOrder\', \'discontinued\', \'inStock\', \'inStoreOnly\', \'limitedAvailability\', \'onlineOnly\', \'outOfStock\', \'preOrder\', \'preSale\', \'soldOut\') NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:enumItemAvailability)\', CHANGE slug slug VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    $this->addSql('ALTER TABLE product_image CHANGE path path VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    $this->addSql('ALTER TABLE segment CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE logo logo VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    $this->addSql('ALTER TABLE shape CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE logo logo VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    $this->addSql('ALTER TABLE shipping_option CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    $this->addSql('ALTER TABLE style CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
  }
}
