<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241210095526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrow ADD borrow_id INT NOT NULL');
        $this->addSql('ALTER TABLE borrow ADD CONSTRAINT FK_55DBA8B0D4C006C8 FOREIGN KEY (borrow_id) REFERENCES book (id)');
        $this->addSql('CREATE INDEX IDX_55DBA8B0D4C006C8 ON borrow (borrow_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrow DROP FOREIGN KEY FK_55DBA8B0D4C006C8');
        $this->addSql('DROP INDEX IDX_55DBA8B0D4C006C8 ON borrow');
        $this->addSql('ALTER TABLE borrow DROP borrow_id');
    }
}