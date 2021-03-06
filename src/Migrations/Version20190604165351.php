<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190604165351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE keywords (id INT AUTO_INCREMENT NOT NULL, list LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ranking_pages (id INT AUTO_INCREMENT NOT NULL, search_engine_id INT NOT NULL, thematic_id INT NOT NULL, number_page INT NOT NULL, position INT NOT NULL, position_previous INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_2DB0B2C45C978CA2 (search_engine_id), INDEX IDX_2DB0B2C42395FCED (thematic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE search_engine (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, variables VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE settings (id INT AUTO_INCREMENT NOT NULL, website_id INT NOT NULL, search_engine_id INT NOT NULL, enabled TINYINT(1) NOT NULL, limit_page INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_E545A0C518F45C82 (website_id), INDEX IDX_E545A0C55C978CA2 (search_engine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thematic (id INT AUTO_INCREMENT NOT NULL, keywords_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_7C1CDF726205D0B8 (keywords_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE website (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_476F5DE75E237E06 (name), UNIQUE INDEX UNIQ_476F5DE7F47645AE (url), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE website_thematic (website_id INT NOT NULL, thematic_id INT NOT NULL, INDEX IDX_AD0B96FF18F45C82 (website_id), INDEX IDX_AD0B96FF2395FCED (thematic_id), PRIMARY KEY(website_id, thematic_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ranking_pages ADD CONSTRAINT FK_2DB0B2C45C978CA2 FOREIGN KEY (search_engine_id) REFERENCES search_engine (id)');
        $this->addSql('ALTER TABLE ranking_pages ADD CONSTRAINT FK_2DB0B2C42395FCED FOREIGN KEY (thematic_id) REFERENCES thematic (id)');
        $this->addSql('ALTER TABLE settings ADD CONSTRAINT FK_E545A0C518F45C82 FOREIGN KEY (website_id) REFERENCES website (id)');
        $this->addSql('ALTER TABLE settings ADD CONSTRAINT FK_E545A0C55C978CA2 FOREIGN KEY (search_engine_id) REFERENCES search_engine (id)');
        $this->addSql('ALTER TABLE thematic ADD CONSTRAINT FK_7C1CDF726205D0B8 FOREIGN KEY (keywords_id) REFERENCES keywords (id)');
        $this->addSql('ALTER TABLE website_thematic ADD CONSTRAINT FK_AD0B96FF18F45C82 FOREIGN KEY (website_id) REFERENCES website (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE website_thematic ADD CONSTRAINT FK_AD0B96FF2395FCED FOREIGN KEY (thematic_id) REFERENCES thematic (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE thematic DROP FOREIGN KEY FK_7C1CDF726205D0B8');
        $this->addSql('ALTER TABLE ranking_pages DROP FOREIGN KEY FK_2DB0B2C45C978CA2');
        $this->addSql('ALTER TABLE settings DROP FOREIGN KEY FK_E545A0C55C978CA2');
        $this->addSql('ALTER TABLE ranking_pages DROP FOREIGN KEY FK_2DB0B2C42395FCED');
        $this->addSql('ALTER TABLE website_thematic DROP FOREIGN KEY FK_AD0B96FF2395FCED');
        $this->addSql('ALTER TABLE settings DROP FOREIGN KEY FK_E545A0C518F45C82');
        $this->addSql('ALTER TABLE website_thematic DROP FOREIGN KEY FK_AD0B96FF18F45C82');
        $this->addSql('DROP TABLE keywords');
        $this->addSql('DROP TABLE ranking_pages');
        $this->addSql('DROP TABLE search_engine');
        $this->addSql('DROP TABLE settings');
        $this->addSql('DROP TABLE thematic');
        $this->addSql('DROP TABLE website');
        $this->addSql('DROP TABLE website_thematic');
    }
}
