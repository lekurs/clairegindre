<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180604144622 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clairegindre_mail ADD user_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE clairegindre_mail ADD CONSTRAINT FK_B916B31EA76ED395 FOREIGN KEY (user_id) REFERENCES clairegindre_user (id)');
        $this->addSql('CREATE INDEX IDX_B916B31EA76ED395 ON clairegindre_mail (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clairegindre_mail DROP FOREIGN KEY FK_B916B31EA76ED395');
        $this->addSql('DROP INDEX IDX_B916B31EA76ED395 ON clairegindre_mail');
        $this->addSql('ALTER TABLE clairegindre_mail DROP user_id');
    }
}