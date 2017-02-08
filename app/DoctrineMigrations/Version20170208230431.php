<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170208230431 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bot_config (id VARCHAR(64) NOT NULL, bot_id VARCHAR(32) NOT NULL, `key` VARCHAR(64) NOT NULL, value VARCHAR(256) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE system_config (id VARCHAR(64) NOT NULL, `key` VARCHAR(32) NOT NULL, value VARCHAR(256) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (user_id VARCHAR(64) NOT NULL, twitch_id VARCHAR(64) NOT NULL, display_name VARCHAR(128) NOT NULL, channel VARCHAR(128) NOT NULL, oauth_token VARCHAR(64) NOT NULL, oauth_refresh_token VARCHAR(256) NOT NULL, scope VARCHAR(256) NOT NULL, created BIGINT NOT NULL, last_login BIGINT NOT NULL, PRIMARY KEY(user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE bot_config');
        $this->addSql('DROP TABLE system_config');
        $this->addSql('DROP TABLE user');
    }
}
