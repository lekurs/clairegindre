<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180604143227 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clairegindre_mail (id VARCHAR(255) NOT NULL, answer_id VARCHAR(255) DEFAULT NULL, content LONGTEXT NOT NULL, `from` VARCHAR(100) NOT NULL, subject VARCHAR(100) NOT NULL, `to` VARCHAR(100) NOT NULL, is_answered TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_B916B31EAA334807 (answer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clairegindre_mail ADD CONSTRAINT FK_B916B31EAA334807 FOREIGN KEY (answer_id) REFERENCES clairegindre_mail (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clairegindre_mail DROP FOREIGN KEY FK_B916B31EAA334807');
        $this->addSql('DROP TABLE clairegindre_mail');
    }
}
