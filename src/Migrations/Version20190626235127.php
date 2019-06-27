<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190626235127 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE demandes (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, createur_id INT NOT NULL, titre VARCHAR(255) NOT NULL, sommaire VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, budget INT DEFAULT NULL, created_at DATETIME NOT NULL, deadline DATETIME NOT NULL, is_ouverte TINYINT(1) NOT NULL, is_valide TINYINT(1) NOT NULL, nombre_votes INT DEFAULT NULL, INDEX IDX_BD940CBBBCF5E72D (categorie_id), INDEX IDX_BD940CBB73A201E5 (createur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demandes_citoyen (demandes_id INT NOT NULL, citoyen_id INT NOT NULL, INDEX IDX_D8AA2FA4F49DCC2D (demandes_id), INDEX IDX_D8AA2FA443787BBA (citoyen_id), PRIMARY KEY(demandes_id, citoyen_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote (id INT AUTO_INCREMENT NOT NULL, citoyen_id INT DEFAULT NULL, demande_id INT DEFAULT NULL, etat VARCHAR(255) NOT NULL, INDEX IDX_5A10856443787BBA (citoyen_id), INDEX IDX_5A10856480E95E18 (demande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE budget (id INT AUTO_INCREMENT NOT NULL, montant INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE citoyen (id INT AUTO_INCREMENT NOT NULL, numero_electeur VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nombre_votes INT DEFAULT NULL, nombre_propositions INT DEFAULT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8E7EF6ACD081A090 (numero_electeur), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demandes ADD CONSTRAINT FK_BD940CBBBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE demandes ADD CONSTRAINT FK_BD940CBB73A201E5 FOREIGN KEY (createur_id) REFERENCES citoyen (id)');
        $this->addSql('ALTER TABLE demandes_citoyen ADD CONSTRAINT FK_D8AA2FA4F49DCC2D FOREIGN KEY (demandes_id) REFERENCES demandes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demandes_citoyen ADD CONSTRAINT FK_D8AA2FA443787BBA FOREIGN KEY (citoyen_id) REFERENCES citoyen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A10856443787BBA FOREIGN KEY (citoyen_id) REFERENCES citoyen (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A10856480E95E18 FOREIGN KEY (demande_id) REFERENCES demandes (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE demandes_citoyen DROP FOREIGN KEY FK_D8AA2FA4F49DCC2D');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A10856480E95E18');
        $this->addSql('ALTER TABLE demandes DROP FOREIGN KEY FK_BD940CBBBCF5E72D');
        $this->addSql('ALTER TABLE demandes DROP FOREIGN KEY FK_BD940CBB73A201E5');
        $this->addSql('ALTER TABLE demandes_citoyen DROP FOREIGN KEY FK_D8AA2FA443787BBA');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A10856443787BBA');
        $this->addSql('DROP TABLE demandes');
        $this->addSql('DROP TABLE demandes_citoyen');
        $this->addSql('DROP TABLE vote');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE budget');
        $this->addSql('DROP TABLE citoyen');
    }
}
