<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130221115039 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE local_category DROP FOREIGN KEY FK_95D8335912469DE2");
        $this->addSql("ALTER TABLE local_category DROP FOREIGN KEY FK_95D833595D5A2101");
        $this->addSql("ALTER TABLE local_category ADD CONSTRAINT FK_95D8335912469DE2 FOREIGN KEY (category_id) REFERENCES lcl_dictionary (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE local_category ADD CONSTRAINT FK_95D833595D5A2101 FOREIGN KEY (local_id) REFERENCES lcl_local (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE local_specific DROP FOREIGN KEY FK_D45ACFCA56ACD7B7");
        $this->addSql("ALTER TABLE local_specific DROP FOREIGN KEY FK_D45ACFCA5D5A2101");
        $this->addSql("ALTER TABLE local_specific ADD CONSTRAINT FK_D45ACFCA56ACD7B7 FOREIGN KEY (specific_id) REFERENCES lcl_dictionary (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE local_specific ADD CONSTRAINT FK_D45ACFCA5D5A2101 FOREIGN KEY (local_id) REFERENCES lcl_local (id) ON DELETE CASCADE");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE local_category DROP FOREIGN KEY FK_95D833595D5A2101");
        $this->addSql("ALTER TABLE local_category DROP FOREIGN KEY FK_95D8335912469DE2");
        $this->addSql("ALTER TABLE local_category ADD CONSTRAINT FK_95D833595D5A2101 FOREIGN KEY (local_id) REFERENCES lcl_local (id)");
        $this->addSql("ALTER TABLE local_category ADD CONSTRAINT FK_95D8335912469DE2 FOREIGN KEY (category_id) REFERENCES lcl_dictionary (id)");
        $this->addSql("ALTER TABLE local_specific DROP FOREIGN KEY FK_D45ACFCA5D5A2101");
        $this->addSql("ALTER TABLE local_specific DROP FOREIGN KEY FK_D45ACFCA56ACD7B7");
        $this->addSql("ALTER TABLE local_specific ADD CONSTRAINT FK_D45ACFCA5D5A2101 FOREIGN KEY (local_id) REFERENCES lcl_local (id)");
        $this->addSql("ALTER TABLE local_specific ADD CONSTRAINT FK_D45ACFCA56ACD7B7 FOREIGN KEY (specific_id) REFERENCES lcl_dictionary (id)");
    }
}
