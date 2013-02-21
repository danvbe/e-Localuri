<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130221114731 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE lcl_dictionary DROP FOREIGN KEY FK_FE9E5468C54C8C93");
        $this->addSql("ALTER TABLE lcl_dictionary ADD CONSTRAINT FK_FE9E5468C54C8C93 FOREIGN KEY (type_id) REFERENCES lcl_dictionary (id) ON DELETE CASCADE");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE lcl_dictionary DROP FOREIGN KEY FK_FE9E5468C54C8C93");
        $this->addSql("ALTER TABLE lcl_dictionary ADD CONSTRAINT FK_FE9E5468C54C8C93 FOREIGN KEY (type_id) REFERENCES lcl_dictionary (id)");
    }
}
