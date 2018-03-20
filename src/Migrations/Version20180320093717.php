<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180320093717 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(150) NOT NULL, category LONGTEXT NOT NULL, date DATE NOT NULL, online TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, categories_id INT DEFAULT NULL, posts LONGTEXT NOT NULL, INDEX IDX_885DBAFAA21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAA21214B7 FOREIGN KEY (categories_id) REFERENCES category (id)');
        $this->addSql('DROP TABLE register');
        $this->addSql('ALTER TABLE reviews CHANGE name title VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAA21214B7');
        $this->addSql('CREATE TABLE register (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, name VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, lastname VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, password VARCHAR(30) DEFAULT NULL COLLATE utf8_unicode_ci, date_wedding DATE DEFAULT NULL, picture VARCHAR(300) NOT NULL COLLATE utf8_unicode_ci, type VARCHAR(50) DEFAULT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE posts');
        $this->addSql('ALTER TABLE reviews CHANGE title name VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci');
    }
}
