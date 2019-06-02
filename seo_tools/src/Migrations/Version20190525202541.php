<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190525202541 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE thematic ADD ranking_page_id INT DEFAULT NULL, ADD keywords_id INT DEFAULT NULL, ADD web_site_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE thematic ADD CONSTRAINT FK_7C1CDF72497358E FOREIGN KEY (ranking_page_id) REFERENCES ranking_page (id)');
        $this->addSql('ALTER TABLE thematic ADD CONSTRAINT FK_7C1CDF726205D0B8 FOREIGN KEY (keywords_id) REFERENCES keywords (id)');
        $this->addSql('ALTER TABLE thematic ADD CONSTRAINT FK_7C1CDF721E12B8D8 FOREIGN KEY (web_site_id) REFERENCES website (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C1CDF72497358E ON thematic (ranking_page_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C1CDF726205D0B8 ON thematic (keywords_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C1CDF721E12B8D8 ON thematic (web_site_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE thematic DROP FOREIGN KEY FK_7C1CDF72497358E');
        $this->addSql('ALTER TABLE thematic DROP FOREIGN KEY FK_7C1CDF726205D0B8');
        $this->addSql('ALTER TABLE thematic DROP FOREIGN KEY FK_7C1CDF721E12B8D8');
        $this->addSql('DROP INDEX UNIQ_7C1CDF72497358E ON thematic');
        $this->addSql('DROP INDEX UNIQ_7C1CDF726205D0B8 ON thematic');
        $this->addSql('DROP INDEX UNIQ_7C1CDF721E12B8D8 ON thematic');
        $this->addSql('ALTER TABLE thematic DROP ranking_page_id, DROP keywords_id, DROP web_site_id');
    }
}
