<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180808092234 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE champignon (id INT AUTO_INCREMENT NOT NULL, cha_espece VARCHAR(255) NOT NULL, cha_nom VARCHAR(255) NOT NULL, cha_comestible VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaires_user (id INT AUTO_INCREMENT NOT NULL, com_id_user_id INT DEFAULT NULL, com_id_spot_id INT NOT NULL, com_text LONGTEXT DEFAULT NULL, INDEX IDX_2554AB03CF468AC9 (com_id_user_id), INDEX IDX_2554AB0345D98A20 (com_id_spot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo_user (id INT AUTO_INCREMENT NOT NULL, pho_id_user_id INT DEFAULT NULL, pho_id_spot_id INT DEFAULT NULL, pho_url VARCHAR(255) NOT NULL, INDEX IDX_CA264BD44DD0BB9 (pho_id_user_id), INDEX IDX_CA264BDCE420B50 (pho_id_spot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spot (id INT AUTO_INCREMENT NOT NULL, spo_id_user_id INT NOT NULL, spo_id_champi_id INT NOT NULL, spo_photo VARCHAR(255) DEFAULT NULL, spo_accessibilite VARCHAR(255) NOT NULL, spo_qualite VARCHAR(255) NOT NULL, spo_coordonnee VARCHAR(255) NOT NULL, spo_description LONGTEXT DEFAULT NULL, INDEX IDX_B9327A73D6B85BD5 (spo_id_user_id), INDEX IDX_B9327A732CA438B1 (spo_id_champi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, use_pseudo VARCHAR(255) NOT NULL, use_nom VARCHAR(255) NOT NULL, use_email VARCHAR(255) NOT NULL, use_password VARCHAR(255) NOT NULL, use_role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaires_user ADD CONSTRAINT FK_2554AB03CF468AC9 FOREIGN KEY (com_id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaires_user ADD CONSTRAINT FK_2554AB0345D98A20 FOREIGN KEY (com_id_spot_id) REFERENCES spot (id)');
        $this->addSql('ALTER TABLE photo_user ADD CONSTRAINT FK_CA264BD44DD0BB9 FOREIGN KEY (pho_id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE photo_user ADD CONSTRAINT FK_CA264BDCE420B50 FOREIGN KEY (pho_id_spot_id) REFERENCES spot (id)');
        $this->addSql('ALTER TABLE spot ADD CONSTRAINT FK_B9327A73D6B85BD5 FOREIGN KEY (spo_id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE spot ADD CONSTRAINT FK_B9327A732CA438B1 FOREIGN KEY (spo_id_champi_id) REFERENCES champignon (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE spot DROP FOREIGN KEY FK_B9327A732CA438B1');
        $this->addSql('ALTER TABLE commentaires_user DROP FOREIGN KEY FK_2554AB0345D98A20');
        $this->addSql('ALTER TABLE photo_user DROP FOREIGN KEY FK_CA264BDCE420B50');
        $this->addSql('ALTER TABLE commentaires_user DROP FOREIGN KEY FK_2554AB03CF468AC9');
        $this->addSql('ALTER TABLE photo_user DROP FOREIGN KEY FK_CA264BD44DD0BB9');
        $this->addSql('ALTER TABLE spot DROP FOREIGN KEY FK_B9327A73D6B85BD5');
        $this->addSql('DROP TABLE champignon');
        $this->addSql('DROP TABLE commentaires_user');
        $this->addSql('DROP TABLE photo_user');
        $this->addSql('DROP TABLE spot');
        $this->addSql('DROP TABLE user');
    }
}
