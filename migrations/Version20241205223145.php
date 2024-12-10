<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241205223145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE borrow (id INT AUTO_INCREMENT NOT NULL, book_id INT NOT NULL, user_id INT NOT NULL, borrowb_id INT NOT NULL, borrowus_id INT NOT NULL, borrowdate DATE NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_55DBA8B016A2B381 (book_id), INDEX IDX_55DBA8B0A76ED395 (user_id), INDEX IDX_55DBA8B09ABF075B (borrowb_id), INDEX IDX_55DBA8B0C992C1CC (borrowus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE borrow ADD CONSTRAINT FK_55DBA8B016A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE borrow ADD CONSTRAINT FK_55DBA8B0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE borrow ADD CONSTRAINT FK_55DBA8B09ABF075B FOREIGN KEY (borrowb_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE borrow ADD CONSTRAINT FK_55DBA8B0C992C1CC FOREIGN KEY (borrowus_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE book ADD writeby_id INT NOT NULL, CHANGE published_at published_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331CA351B9C FOREIGN KEY (writeby_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A331CA351B9C ON book (writeby_id)');
        $this->addSql('ALTER TABLE user CHANGE password pass_word VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrow DROP FOREIGN KEY FK_55DBA8B016A2B381');
        $this->addSql('ALTER TABLE borrow DROP FOREIGN KEY FK_55DBA8B0A76ED395');
        $this->addSql('ALTER TABLE borrow DROP FOREIGN KEY FK_55DBA8B09ABF075B');
        $this->addSql('ALTER TABLE borrow DROP FOREIGN KEY FK_55DBA8B0C992C1CC');
        $this->addSql('DROP TABLE borrow');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331CA351B9C');
        $this->addSql('DROP INDEX IDX_CBE5A331CA351B9C ON book');
        $this->addSql('ALTER TABLE book DROP writeby_id, CHANGE published_at published_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user CHANGE pass_word password VARCHAR(255) NOT NULL');
    }
}
