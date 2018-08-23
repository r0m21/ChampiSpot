<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180823144824 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE signalement DROP FOREIGN KEY FK_F4B5511469B981F0');
        $this->addSql('DROP INDEX IDX_F4B5511469B981F0 ON signalement');
        $this->addSql('ALTER TABLE signalement ADD sig_id_user_id INT NOT NULL, CHANGE sig_id_spot_id sig_id_spot_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE signalement ADD CONSTRAINT FK_F4B5511443A014AB FOREIGN KEY (sig_id_spot_id_id) REFERENCES spot (id)');
        $this->addSql('ALTER TABLE signalement ADD CONSTRAINT FK_F4B55114E3268119 FOREIGN KEY (sig_id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F4B5511443A014AB ON signalement (sig_id_spot_id_id)');
        $this->addSql('CREATE INDEX IDX_F4B55114E3268119 ON signalement (sig_id_user_id)');
        $this->addSql('ALTER TABLE user ADD use_role VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE signalement DROP FOREIGN KEY FK_F4B5511443A014AB');
        $this->addSql('ALTER TABLE signalement DROP FOREIGN KEY FK_F4B55114E3268119');
        $this->addSql('DROP INDEX IDX_F4B5511443A014AB ON signalement');
        $this->addSql('DROP INDEX IDX_F4B55114E3268119 ON signalement');
        $this->addSql('ALTER TABLE signalement ADD sig_id_spot_id INT NOT NULL, DROP sig_id_spot_id_id, DROP sig_id_user_id');
        $this->addSql('ALTER TABLE signalement ADD CONSTRAINT FK_F4B5511469B981F0 FOREIGN KEY (sig_id_spot_id) REFERENCES spot (id)');
        $this->addSql('CREATE INDEX IDX_F4B5511469B981F0 ON signalement (sig_id_spot_id)');
        $this->addSql('ALTER TABLE user DROP use_role');
    }
}
