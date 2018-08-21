<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180821075838 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE signalement CHANGE sig_id_spot sig_id_spot_id INT NOT NULL');
        $this->addSql('ALTER TABLE signalement ADD CONSTRAINT FK_F4B5511469B981F0 FOREIGN KEY (sig_id_spot_id) REFERENCES spot (id)');
        $this->addSql('CREATE INDEX IDX_F4B5511469B981F0 ON signalement (sig_id_spot_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE signalement DROP FOREIGN KEY FK_F4B5511469B981F0');
        $this->addSql('DROP INDEX IDX_F4B5511469B981F0 ON signalement');
        $this->addSql('ALTER TABLE signalement CHANGE sig_id_spot_id sig_id_spot INT NOT NULL');
    }
}
