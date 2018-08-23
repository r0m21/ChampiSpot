<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180823124933 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64988EC9851');
        $this->addSql('DROP INDEX IDX_8D93D64988EC9851 ON user');
        $this->addSql('ALTER TABLE user ADD use_role_id INT DEFAULT 2 NOT NULL, DROP use_role_id_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD use_role_id_id INT DEFAULT NULL, DROP use_role_id');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64988EC9851 FOREIGN KEY (use_role_id_id) REFERENCES role_utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64988EC9851 ON user (use_role_id_id)');
    }
}
