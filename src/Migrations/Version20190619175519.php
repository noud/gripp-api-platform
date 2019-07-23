<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190619175519 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'API User.';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE api_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, api_token VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AC64A0BAF85E0677 ON api_user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AC64A0BA7BA2F5EB ON api_user (api_token)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_AC64A0BA7BA2F5EB ON api_user');
        $this->addSql('DROP INDEX UNIQ_AC64A0BAF85E0677 ON api_user');
        $this->addSql('DROP TABLE api_user');
    }
}
