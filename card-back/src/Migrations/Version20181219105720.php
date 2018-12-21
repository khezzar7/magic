<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181219105720 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE magic (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, edition VARCHAR(255) NOT NULL, rarity VARCHAR(255) NOT NULL, artist VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE card');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE card (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, body LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, edition VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, rarity VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, artist VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE magic');
    }
}
