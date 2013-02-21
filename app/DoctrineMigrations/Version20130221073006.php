<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130221073006 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE lcl_media (id INT AUTO_INCREMENT NOT NULL, file_name VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_1FFA0BE4D7DF1668 (file_name), PRIMARY KEY(id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE lcl_local ADD image INT DEFAULT NULL");
        $this->addSql("ALTER TABLE lcl_local ADD CONSTRAINT FK_FE002200C53D045F FOREIGN KEY (image) REFERENCES lcl_media (id)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_FE002200C53D045F ON lcl_local (image)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE lcl_local DROP FOREIGN KEY FK_FE002200C53D045F");
        $this->addSql("DROP TABLE lcl_media");
        $this->addSql("ALTER TABLE lcl_local DROP FOREIGN KEY FK_FE002200C53D045F");
        $this->addSql("DROP INDEX UNIQ_FE002200C53D045F ON lcl_local");
        $this->addSql("ALTER TABLE lcl_local DROP image");
    }
}
