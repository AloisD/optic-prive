<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131093124 extends AbstractMigration
{
  public function getDescription(): string
  {
    return 'Added state field into product table';
  }

  public function up(Schema $schema): void
  {
    // this up() migration is auto-generated, please modify it to your needs
    $this->addSql('ALTER TABLE product ADD state ENUM(\'damagedCondition\', \'newCondition\', \'refurbishedCondition\', \'usedCondition\') NOT NULL COMMENT \'(DC2Type:enumState)\'');
  }

  public function down(Schema $schema): void
  {
    // this down() migration is auto-generated, please modify it to your needs
    $this->addSql('ALTER TABLE product DROP state');
  }
}
