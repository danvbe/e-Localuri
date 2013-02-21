<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130221105215 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE local_category (local_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_95D833595D5A2101 (local_id), INDEX IDX_95D8335912469DE2 (category_id), PRIMARY KEY(local_id, category_id)) ENGINE = InnoDB");
        $this->addSql("CREATE TABLE local_specific (local_id INT NOT NULL, specific_id INT NOT NULL, INDEX IDX_D45ACFCA5D5A2101 (local_id), INDEX IDX_D45ACFCA56ACD7B7 (specific_id), PRIMARY KEY(local_id, specific_id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE local_category ADD CONSTRAINT FK_95D833595D5A2101 FOREIGN KEY (local_id) REFERENCES lcl_local (id)");
        $this->addSql("ALTER TABLE local_category ADD CONSTRAINT FK_95D8335912469DE2 FOREIGN KEY (category_id) REFERENCES lcl_dictionary (id)");
        $this->addSql("ALTER TABLE local_specific ADD CONSTRAINT FK_D45ACFCA5D5A2101 FOREIGN KEY (local_id) REFERENCES lcl_local (id)");
        $this->addSql("ALTER TABLE local_specific ADD CONSTRAINT FK_D45ACFCA56ACD7B7 FOREIGN KEY (specific_id) REFERENCES lcl_dictionary (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE local_category");
        $this->addSql("DROP TABLE local_specific");
    }
}
