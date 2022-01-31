<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131162206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Added uv_protection field into product table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD uv_protection ENUM(\'category0\', \'category1\', \'category2\', \'category3\', \'category4\') DEFAULT NULL COMMENT \'(DC2Type:enumUvProtection)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP uv_protection');
    }
}
