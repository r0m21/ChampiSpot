<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180808075658 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE champignon ADD cha_espece VARCHAR(255) NOT NULL, ADD cha_nom VARCHAR(255) NOT NULL, ADD cha_comestible VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commentaires_user ADD com_url LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE photo_user ADD pho_url VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE spot ADD spo_photo VARCHAR(255) DEFAULT NULL, ADD spo_accessibilite VARCHAR(255) NOT NULL, ADD spo_qualite VARCHAR(255) NOT NULL, ADD spo_coordonnee VARCHAR(255) NOT NULL, ADD spo_description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD use_pseudo VARCHAR(255) NOT NULL, ADD use_nom VARCHAR(255) NOT NULL, ADD use_email VARCHAR(255) NOT NULL, ADD use_password VARCHAR(255) NOT NULL, ADD use_role VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE champignon DROP cha_espece, DROP cha_nom, DROP cha_comestible');
        $this->addSql('ALTER TABLE commentaires_user DROP com_url');
        $this->addSql('ALTER TABLE photo_user DROP pho_url');
        $this->addSql('ALTER TABLE spot DROP spo_photo, DROP spo_accessibilite, DROP spo_qualite, DROP spo_coordonnee, DROP spo_description');
        $this->addSql('ALTER TABLE user DROP use_pseudo, DROP use_nom, DROP use_email, DROP use_password, DROP use_role');
    }
}
