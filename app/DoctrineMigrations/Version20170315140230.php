<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170315140230 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_data DROP FOREIGN KEY FK_D772BFAAA76ED395');
        $this->addSql('DROP INDEX UNIQ_D772BFAAA76ED395 ON user_data');
        $this->addSql('ALTER TABLE user_data ADD twitch_entity_id VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE user_data ADD CONSTRAINT FK_D772BFAAB89F7AB5 FOREIGN KEY (twitch_entity_id) REFERENCES twitch_user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D772BFAAB89F7AB5 ON user_data (twitch_entity_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_data DROP FOREIGN KEY FK_D772BFAAB89F7AB5');
        $this->addSql('DROP INDEX UNIQ_D772BFAAB89F7AB5 ON user_data');
        $this->addSql('ALTER TABLE user_data DROP twitch_entity_id');
        $this->addSql('ALTER TABLE user_data ADD CONSTRAINT FK_D772BFAAA76ED395 FOREIGN KEY (user_id) REFERENCES twitch_user (local_userid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D772BFAAA76ED395 ON user_data (user_id)');
    }
}
