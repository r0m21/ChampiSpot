<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180823163103 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE signalement ADD CONSTRAINT FK_F4B55114E3268119 FOREIGN KEY (sig_id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F4B55114E3268119 ON signalement (sig_id_user_id)');
        $this->addSql('ALTER TABLE user ADD use_role VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE signalement DROP FOREIGN KEY FK_F4B55114E3268119');
        $this->addSql('DROP INDEX IDX_F4B55114E3268119 ON signalement');
        $this->addSql('ALTER TABLE user DROP use_role');
    }
}
