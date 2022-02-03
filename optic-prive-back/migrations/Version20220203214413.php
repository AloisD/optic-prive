<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220203214413 extends AbstractMigration
{
  public function getDescription(): string
  {
    return 'Add created_at and updated_at into table LensType';
  }

  public function up(Schema $schema): void
  {
    // this up() migration is auto-generated, please modify it to your needs
    $this->addSql('ALTER TABLE lens_type ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
  }

  public function down(Schema $schema): void
  {
    // this down() migration is auto-generated, please modify it to your needs
    $this->addSql('ALTER TABLE lens_type DROP created_at, DROP updated_at');
  }
}
