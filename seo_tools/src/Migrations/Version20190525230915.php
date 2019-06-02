<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190525230915 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE keywords ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE ranking_page DROP FOREIGN KEY FK_BD3739AA2395FCED');
        $this->addSql('ALTER TABLE ranking_page ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME DEFAULT NULL, CHANGE thematic_id thematic_id INT NOT NULL');
        $this->addSql('ALTER TABLE ranking_page ADD CONSTRAINT FK_BD3739AA2395FCED FOREIGN KEY (thematic_id) REFERENCES thematic (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE search_engine ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE thematic DROP FOREIGN KEY FK_7C1CDF721E12B8D8');
        $this->addSql('ALTER TABLE thematic ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME DEFAULT NULL, CHANGE keywords_id keywords_id INT NOT NULL, CHANGE web_site_id web_site_id INT NOT NULL');
        $this->addSql('ALTER TABLE thematic ADD CONSTRAINT FK_7C1CDF721E12B8D8 FOREIGN KEY (web_site_id) REFERENCES website (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE website ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE keywords DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE ranking_page DROP FOREIGN KEY FK_BD3739AA2395FCED');
        $this->addSql('ALTER TABLE ranking_page DROP created_at, DROP updated_at, CHANGE thematic_id thematic_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ranking_page ADD CONSTRAINT FK_BD3739AA2395FCED FOREIGN KEY (thematic_id) REFERENCES thematic (id)');
        $this->addSql('ALTER TABLE search_engine DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE thematic DROP FOREIGN KEY FK_7C1CDF721E12B8D8');
        $this->addSql('ALTER TABLE thematic DROP created_at, DROP updated_at, CHANGE keywords_id keywords_id INT DEFAULT NULL, CHANGE web_site_id web_site_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE thematic ADD CONSTRAINT FK_7C1CDF721E12B8D8 FOREIGN KEY (web_site_id) REFERENCES website (id)');
        $this->addSql('ALTER TABLE website DROP created_at, DROP updated_at');
    }
}
