<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180821180755 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE signalement (id INT AUTO_INCREMENT NOT NULL, sig_id_spot_id INT NOT NULL, sig_vide VARCHAR(255) NOT NULL, sig_toxique VARCHAR(255) NOT NULL, sig_desc VARCHAR(255) NOT NULL, sig_accessibilite VARCHAR(255) NOT NULL, INDEX IDX_F4B5511469B981F0 (sig_id_spot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE signalement ADD CONSTRAINT FK_F4B5511469B981F0 FOREIGN KEY (sig_id_spot_id) REFERENCES spot (id)');
        $this->addSql('ALTER TABLE user ADD use_profile_pic VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE signalement');
        $this->addSql('ALTER TABLE user DROP use_profile_pic');
    }
}
