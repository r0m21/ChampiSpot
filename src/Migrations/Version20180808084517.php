<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180808084517 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE champignon ADD cha_espece VARCHAR(255) NOT NULL, ADD cha_nom VARCHAR(255) NOT NULL, ADD cha_comestible VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commentaires_user ADD com_id_user_id INT DEFAULT NULL, ADD com_id_spot_id INT NOT NULL, ADD com_text LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaires_user ADD CONSTRAINT FK_2554AB03CF468AC9 FOREIGN KEY (com_id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaires_user ADD CONSTRAINT FK_2554AB0345D98A20 FOREIGN KEY (com_id_spot_id) REFERENCES spot (id)');
        $this->addSql('CREATE INDEX IDX_2554AB03CF468AC9 ON commentaires_user (com_id_user_id)');
        $this->addSql('CREATE INDEX IDX_2554AB0345D98A20 ON commentaires_user (com_id_spot_id)');
        $this->addSql('ALTER TABLE photo_user ADD pho_id_user_id INT DEFAULT NULL, ADD pho_id_spot_id INT DEFAULT NULL, ADD pho_url VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE photo_user ADD CONSTRAINT FK_CA264BD44DD0BB9 FOREIGN KEY (pho_id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE photo_user ADD CONSTRAINT FK_CA264BDCE420B50 FOREIGN KEY (pho_id_spot_id) REFERENCES spot (id)');
        $this->addSql('CREATE INDEX IDX_CA264BD44DD0BB9 ON photo_user (pho_id_user_id)');
        $this->addSql('CREATE INDEX IDX_CA264BDCE420B50 ON photo_user (pho_id_spot_id)');
        $this->addSql('ALTER TABLE spot ADD spo_id_user_id INT NOT NULL, ADD spo_id_champi_id INT NOT NULL, ADD spo_photo VARCHAR(255) DEFAULT NULL, ADD spo_accessibilite VARCHAR(255) NOT NULL, ADD spo_qualite VARCHAR(255) NOT NULL, ADD spo_coordonnee VARCHAR(255) NOT NULL, ADD spo_description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE spot ADD CONSTRAINT FK_B9327A73D6B85BD5 FOREIGN KEY (spo_id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE spot ADD CONSTRAINT FK_B9327A732CA438B1 FOREIGN KEY (spo_id_champi_id) REFERENCES champignon (id)');
        $this->addSql('CREATE INDEX IDX_B9327A73D6B85BD5 ON spot (spo_id_user_id)');
        $this->addSql('CREATE INDEX IDX_B9327A732CA438B1 ON spot (spo_id_champi_id)');
        $this->addSql('ALTER TABLE user ADD use_pseudo VARCHAR(255) NOT NULL, ADD use_nom VARCHAR(255) NOT NULL, ADD use_email VARCHAR(255) NOT NULL, ADD use_password VARCHAR(255) NOT NULL, ADD use_role VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE champignon DROP cha_espece, DROP cha_nom, DROP cha_comestible');
        $this->addSql('ALTER TABLE commentaires_user DROP FOREIGN KEY FK_2554AB03CF468AC9');
        $this->addSql('ALTER TABLE commentaires_user DROP FOREIGN KEY FK_2554AB0345D98A20');
        $this->addSql('DROP INDEX IDX_2554AB03CF468AC9 ON commentaires_user');
        $this->addSql('DROP INDEX IDX_2554AB0345D98A20 ON commentaires_user');
        $this->addSql('ALTER TABLE commentaires_user DROP com_id_user_id, DROP com_id_spot_id, DROP com_text');
        $this->addSql('ALTER TABLE photo_user DROP FOREIGN KEY FK_CA264BD44DD0BB9');
        $this->addSql('ALTER TABLE photo_user DROP FOREIGN KEY FK_CA264BDCE420B50');
        $this->addSql('DROP INDEX IDX_CA264BD44DD0BB9 ON photo_user');
        $this->addSql('DROP INDEX IDX_CA264BDCE420B50 ON photo_user');
        $this->addSql('ALTER TABLE photo_user DROP pho_id_user_id, DROP pho_id_spot_id, DROP pho_url');
        $this->addSql('ALTER TABLE spot DROP FOREIGN KEY FK_B9327A73D6B85BD5');
        $this->addSql('ALTER TABLE spot DROP FOREIGN KEY FK_B9327A732CA438B1');
        $this->addSql('DROP INDEX IDX_B9327A73D6B85BD5 ON spot');
        $this->addSql('DROP INDEX IDX_B9327A732CA438B1 ON spot');
        $this->addSql('ALTER TABLE spot DROP spo_id_user_id, DROP spo_id_champi_id, DROP spo_photo, DROP spo_accessibilite, DROP spo_qualite, DROP spo_coordonnee, DROP spo_description');
        $this->addSql('ALTER TABLE user DROP use_pseudo, DROP use_nom, DROP use_email, DROP use_password, DROP use_role');
    }
}
