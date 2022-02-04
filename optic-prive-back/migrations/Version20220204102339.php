<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204102339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add foreign key segment_id in table product';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD segment_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADDB296AAD FOREIGN KEY (segment_id) REFERENCES segment (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADDB296AAD ON product (segment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADDB296AAD');
        $this->addSql('DROP INDEX IDX_D34A04ADDB296AAD ON product');
        $this->addSql('ALTER TABLE product DROP segment_id');
    }
}
