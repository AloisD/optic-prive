<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204151838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add foreign key lens_type_id in table product';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD lens_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA528A4C8 FOREIGN KEY (lens_type_id) REFERENCES lens_type (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADA528A4C8 ON product (lens_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA528A4C8');
        $this->addSql('DROP INDEX IDX_D34A04ADA528A4C8 ON product');
        $this->addSql('ALTER TABLE product DROP lens_type_id');
    }
}
