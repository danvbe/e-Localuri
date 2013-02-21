<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130221084821 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE lcl_local ADD owner_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE lcl_local ADD CONSTRAINT FK_FE0022007E3C61F9 FOREIGN KEY (owner_id) REFERENCES lcl_user (id)");
        $this->addSql("CREATE INDEX IDX_FE0022007E3C61F9 ON lcl_local (owner_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE lcl_local DROP FOREIGN KEY FK_FE0022007E3C61F9");
        $this->addSql("DROP INDEX IDX_FE0022007E3C61F9 ON lcl_local");
        $this->addSql("ALTER TABLE lcl_local DROP owner_id");
    }
}
