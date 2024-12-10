<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241206093557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD writeby_id INT NOT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331CA351B9C FOREIGN KEY (writeby_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A331CA351B9C ON book (writeby_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331CA351B9C');
        $this->addSql('DROP INDEX IDX_CBE5A331CA351B9C ON book');
        $this->addSql('ALTER TABLE book DROP writeby_id');
    }
}
