<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180826133617 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE signalement DROP FOREIGN KEY FK_F4B5511443A014AB');
        $this->addSql('DROP INDEX IDX_F4B5511443A014AB ON signalement');
        $this->addSql('ALTER TABLE signalement DROP sig_id_spot_id_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE signalement ADD sig_id_spot_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE signalement ADD CONSTRAINT FK_F4B5511443A014AB FOREIGN KEY (sig_id_spot_id_id) REFERENCES spot (id)');
        $this->addSql('CREATE INDEX IDX_F4B5511443A014AB ON signalement (sig_id_spot_id_id)');
    }
}
