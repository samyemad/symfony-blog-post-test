<?php

declare(strict_types=1);

namespace migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240307173441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE authors (id UUID NOT NULL, name VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN authors.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE blog_posts (id UUID NOT NULL, parent_id UUID DEFAULT NULL, author_id UUID NOT NULL, title VARCHAR(255) NOT NULL, subtitle VARCHAR(255) NOT NULL, content TEXT NOT NULL, featured_image VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_78B2F932727ACA70 ON blog_posts (parent_id)');
        $this->addSql('CREATE INDEX IDX_78B2F932F675F31B ON blog_posts (author_id)');
        $this->addSql('COMMENT ON COLUMN blog_posts.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN blog_posts.parent_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN blog_posts.author_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE blog_posts ADD CONSTRAINT FK_78B2F932727ACA70 FOREIGN KEY (parent_id) REFERENCES blog_posts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE blog_posts ADD CONSTRAINT FK_78B2F932F675F31B FOREIGN KEY (author_id) REFERENCES authors (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE blog_posts DROP CONSTRAINT FK_78B2F932727ACA70');
        $this->addSql('ALTER TABLE blog_posts DROP CONSTRAINT FK_78B2F932F675F31B');
        $this->addSql('DROP TABLE authors');
        $this->addSql('DROP TABLE blog_posts');
    }
}
