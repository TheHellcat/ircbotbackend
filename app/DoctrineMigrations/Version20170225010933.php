<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170225010933 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_api_token (token_id VARCHAR(64) NOT NULL, token_identifier VARCHAR(128) NOT NULL, token_type VARCHAR(16) NOT NULL, enabled TINYINT(1) NOT NULL, description VARCHAR(256) NOT NULL, PRIMARY KEY(token_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_api_tokenassign (asgn_id VARCHAR(64) NOT NULL, token_id VARCHAR(64) NOT NULL, user_id VARCHAR(64) NOT NULL, INDEX IDX_236FA77D41DEE7B9 (token_id), INDEX IDX_236FA77DA76ED395 (user_id), PRIMARY KEY(asgn_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_api_tokenassign ADD CONSTRAINT FK_236FA77D41DEE7B9 FOREIGN KEY (token_id) REFERENCES user_api_token (token_id)');
        $this->addSql('ALTER TABLE user_api_tokenassign ADD CONSTRAINT FK_236FA77DA76ED395 FOREIGN KEY (user_id) REFERENCES user (user_id)');
        $this->addSql('ALTER TABLE user ADD user_type VARCHAR(16) NOT NULL');
        $this->addSql('CREATE INDEX username_idx ON user (username)');
        $this->addSql('CREATE INDEX type_idx ON user (user_type)');
        $this->addSql('CREATE INDEX created_idx ON user (created)');
        $this->addSql('CREATE INDEX lastlogin_idx ON user (last_login)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_api_tokenassign DROP FOREIGN KEY FK_236FA77D41DEE7B9');
        $this->addSql('DROP TABLE user_api_token');
        $this->addSql('DROP TABLE user_api_tokenassign');
        $this->addSql('DROP INDEX username_idx ON user');
        $this->addSql('DROP INDEX type_idx ON user');
        $this->addSql('DROP INDEX created_idx ON user');
        $this->addSql('DROP INDEX lastlogin_idx ON user');
        $this->addSql('ALTER TABLE user DROP user_type');
    }
}
