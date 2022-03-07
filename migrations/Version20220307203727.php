<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307203727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1C3C6F69F');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D14ACC9A20');
        $this->addSql('DROP INDEX IDX_723705D14ACC9A20 ON transaction');
        $this->addSql('DROP INDEX IDX_723705D1C3C6F69F ON transaction');
        $this->addSql('ALTER TABLE transaction DROP card_id, DROP car_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction ADD card_id INT DEFAULT NULL, ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D14ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id)');
        $this->addSql('CREATE INDEX IDX_723705D14ACC9A20 ON transaction (card_id)');
        $this->addSql('CREATE INDEX IDX_723705D1C3C6F69F ON transaction (car_id)');
    }
}
