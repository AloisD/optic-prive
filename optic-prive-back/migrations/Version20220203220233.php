<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220203220233 extends AbstractMigration
{
  public function getDescription(): string
  {
    return 'Add created_at and updated_at into table shape';
  }

  public function up(Schema $schema): void
  {
    // this up() migration is auto-generated, please modify it to your needs
    $this->addSql('ALTER TABLE shape ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
  }

  public function down(Schema $schema): void
  {
    // this down() migration is auto-generated, please modify it to your needs
    $this->addSql('ALTER TABLE shape DROP created_at, DROP updated_at');
  }
}
