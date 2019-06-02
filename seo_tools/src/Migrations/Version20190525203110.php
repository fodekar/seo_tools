<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190525203110 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ranking_page ADD thematic_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ranking_page ADD CONSTRAINT FK_BD3739AA2395FCED FOREIGN KEY (thematic_id) REFERENCES thematic (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BD3739AA2395FCED ON ranking_page (thematic_id)');
        $this->addSql('ALTER TABLE thematic DROP FOREIGN KEY FK_7C1CDF72497358E');
        $this->addSql('DROP INDEX UNIQ_7C1CDF72497358E ON thematic');
        $this->addSql('ALTER TABLE thematic DROP ranking_page_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ranking_page DROP FOREIGN KEY FK_BD3739AA2395FCED');
        $this->addSql('DROP INDEX UNIQ_BD3739AA2395FCED ON ranking_page');
        $this->addSql('ALTER TABLE ranking_page DROP thematic_id');
        $this->addSql('ALTER TABLE thematic ADD ranking_page_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE thematic ADD CONSTRAINT FK_7C1CDF72497358E FOREIGN KEY (ranking_page_id) REFERENCES ranking_page (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C1CDF72497358E ON thematic (ranking_page_id)');
    }
}
