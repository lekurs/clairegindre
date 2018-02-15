<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180214144722 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reviews ADD user_id INT NOT NULL, CHANGE name name VARCHAR(100) NOT NULL, CHANGE reviews reviews LONGTEXT NOT NULL, CHANGE online online TINYINT(1) DEFAULT \'1\' NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reviews DROP user_id, CHANGE name name VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE reviews reviews LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE online online TINYINT(1) NOT NULL');
    }
}
