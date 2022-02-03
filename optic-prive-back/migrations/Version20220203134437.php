<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220203134437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create foreign key shape_id in table product';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD shape_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD50266CBB FOREIGN KEY (shape_id) REFERENCES shape (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD50266CBB ON product (shape_id)');
        $this->addSql('ALTER TABLE shipping_option CHANGE price price NUMERIC(5, 2) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD50266CBB');
        $this->addSql('DROP INDEX IDX_D34A04AD50266CBB ON product');
        $this->addSql('ALTER TABLE product DROP shape_id');
        $this->addSql('ALTER TABLE shipping_option CHANGE price price DOUBLE PRECISION NOT NULL');
    }
}
