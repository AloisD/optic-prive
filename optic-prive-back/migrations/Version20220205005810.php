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
    $this->addSql('ALTER TABLE product DROP image_name, CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reference reference VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE color_code color_code VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE state state ENUM(\'damagedCondition\', \'newCondition\', \'refurbishedCondition\', \'usedCondition\') NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:enumState)\', CHANGE category category ENUM(\'male\', \'female\', \'child\', \'unisex\') NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:enumCategory)\', CHANGE uv_protection uv_protection ENUM(\'category0\', \'category1\', \'category2\', \'category3\', \'category4\') DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:enumUvProtection)\', CHANGE item_availability item_availability ENUM(\'backOrder\', \'discontinued\', \'inStock\', \'inStoreOnly\', \'limitedAvailability\', \'onlineOnly\', \'outOfStock\', \'preOrder\', \'preSale\', \'soldOut\') NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:enumItemAvailability)\', CHANGE slug slug VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
  }
}
