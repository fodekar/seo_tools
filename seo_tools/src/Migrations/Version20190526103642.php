<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190526103642 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ranking_page DROP FOREIGN KEY FK_BD3739AA2395FCED');
        $this->addSql('DROP INDEX UNIQ_BD3739AA2395FCED ON ranking_page');
        $this->addSql('ALTER TABLE ranking_page DROP thematic_id');
        $this->addSql('ALTER TABLE thematic DROP FOREIGN KEY FK_7C1CDF721E12B8D8');
        $this->addSql('DROP INDEX UNIQ_7C1CDF721E12B8D8 ON thematic');
        $this->addSql('ALTER TABLE thematic DROP web_site_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ranking_page ADD thematic_id INT NOT NULL');
        $this->addSql('ALTER TABLE ranking_page ADD CONSTRAINT FK_BD3739AA2395FCED FOREIGN KEY (thematic_id) REFERENCES thematic (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BD3739AA2395FCED ON ranking_page (thematic_id)');
        $this->addSql('ALTER TABLE thematic ADD web_site_id INT NOT NULL');
        $this->addSql('ALTER TABLE thematic ADD CONSTRAINT FK_7C1CDF721E12B8D8 FOREIGN KEY (web_site_id) REFERENCES website (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C1CDF721E12B8D8 ON thematic (web_site_id)');
    }
}
