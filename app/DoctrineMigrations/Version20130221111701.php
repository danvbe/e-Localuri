<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130221111701 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE lcl_dictionary ADD type_id INT DEFAULT NULL, DROP type_, DROP expired_at, DROP key_");
        $this->addSql("ALTER TABLE lcl_dictionary ADD CONSTRAINT FK_FE9E5468C54C8C93 FOREIGN KEY (type_id) REFERENCES lcl_dictionary (id)");
        $this->addSql("CREATE INDEX IDX_FE9E5468C54C8C93 ON lcl_dictionary (type_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE lcl_dictionary DROP FOREIGN KEY FK_FE9E5468C54C8C93");
        $this->addSql("DROP INDEX IDX_FE9E5468C54C8C93 ON lcl_dictionary");
        $this->addSql("ALTER TABLE lcl_dictionary ADD type_ VARCHAR(255) DEFAULT NULL, ADD expired_at DATETIME DEFAULT NULL, ADD key_ VARCHAR(255) NOT NULL, DROP type_id");
    }
}
