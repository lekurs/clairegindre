<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180226140632 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE register');
        $this->addSql('ALTER TABLE user DROP benefit');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE register (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, name VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, lastname VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, password VARCHAR(30) DEFAULT NULL COLLATE utf8_unicode_ci, date_wedding DATE DEFAULT NULL, picture VARCHAR(300) NOT NULL COLLATE utf8_unicode_ci, type VARCHAR(50) DEFAULT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD benefit VARCHAR(50) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
