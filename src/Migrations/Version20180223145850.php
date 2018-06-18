<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180223145850 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, benefit_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_472B783AA76ED395 (user_id), UNIQUE INDEX UNIQ_472B783AB517B89 (benefit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783AB517B89 FOREIGN KEY (benefit_id) REFERENCES benefit (id)');
        $this->addSql('ALTER TABLE picture ADD gallery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F894E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_16DB4F894E7AF8F ON picture (gallery_id)');
        $this->addSql('ALTER TABLE user DROP is_active');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F894E7AF8F');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP INDEX UNIQ_16DB4F894E7AF8F ON picture');
        $this->addSql('ALTER TABLE picture DROP gallery_id');
        $this->addSql('ALTER TABLE user ADD is_active TINYINT(1) NOT NULL');
    }
}
