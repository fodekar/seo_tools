<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190526202806 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ranking_pages ADD search_engine_id INT NOT NULL, ADD thematic_id INT NOT NULL');
        $this->addSql('ALTER TABLE ranking_pages ADD CONSTRAINT FK_2DB0B2C45C978CA2 FOREIGN KEY (search_engine_id) REFERENCES search_engine (id)');
        $this->addSql('ALTER TABLE ranking_pages ADD CONSTRAINT FK_2DB0B2C42395FCED FOREIGN KEY (thematic_id) REFERENCES thematic (id)');
        $this->addSql('CREATE INDEX IDX_2DB0B2C45C978CA2 ON ranking_pages (search_engine_id)');
        $this->addSql('CREATE INDEX IDX_2DB0B2C42395FCED ON ranking_pages (thematic_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ranking_pages DROP FOREIGN KEY FK_2DB0B2C45C978CA2');
        $this->addSql('ALTER TABLE ranking_pages DROP FOREIGN KEY FK_2DB0B2C42395FCED');
        $this->addSql('DROP INDEX IDX_2DB0B2C45C978CA2 ON ranking_pages');
        $this->addSql('DROP INDEX IDX_2DB0B2C42395FCED ON ranking_pages');
        $this->addSql('ALTER TABLE ranking_pages DROP search_engine_id, DROP thematic_id');
    }
}
