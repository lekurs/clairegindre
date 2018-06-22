<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180622121842 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clairegindre_user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', picture_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', email VARCHAR(255) NOT NULL, username VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, date_wedding DATE DEFAULT NULL, online TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', slug VARCHAR(200) NOT NULL, UNIQUE INDEX UNIQ_65A3C91FE7927C74 (email), UNIQUE INDEX UNIQ_65A3C91FEE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clairegindre_article (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', author_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', prestation_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(100) NOT NULL, content LONGTEXT NOT NULL, online TINYINT(1) NOT NULL, creation_date DATE NOT NULL, modification_date INT DEFAULT NULL, personnal_button VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_818862BEF675F31B (author_id), INDEX IDX_818862BE9E45C554 (prestation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clairegindre_benefit (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(50) NOT NULL, INDEX IDX_DF396CC7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clairegindre_comment (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', author_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', article_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', date DATE NOT NULL, content TINYTEXT NOT NULL, last_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, INDEX IDX_17C63EB4F675F31B (author_id), INDEX IDX_17C63EB47294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clairegindre_gallery (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', article_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', benefit_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(255) NOT NULL, slug VARCHAR(200) NOT NULL, creation_date DATE DEFAULT NULL, event_date DATETIME DEFAULT NULL, event_place VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_C49914E22B36786B (title), UNIQUE INDEX UNIQ_C49914E27294869C (article_id), INDEX IDX_C49914E2A76ED395 (user_id), INDEX IDX_C49914E2B517B89 (benefit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clairegindre_gallery_maker (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', article_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', line INT NOT NULL, display_order INT NOT NULL, INDEX IDX_D42388517294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clairegindre_mail (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', answer_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', from_sender VARCHAR(100) NOT NULL, to_email VARCHAR(100) NOT NULL, subject VARCHAR(100) NOT NULL, content LONGTEXT NOT NULL, is_answered TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B916B31EAA334807 (answer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clairegindre_picture (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', gallery_maker_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', gallery_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', picture_name VARCHAR(100) NOT NULL, public_path VARCHAR(255) NOT NULL, backup_path VARCHAR(255) NOT NULL, extension VARCHAR(5) NOT NULL, display_order INT DEFAULT NULL, favorite TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_956923515D578C78 (gallery_maker_id), INDEX IDX_956923514E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clairegindre_reviews (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', author_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(50) NOT NULL, content LONGTEXT NOT NULL, creation_date DATE NOT NULL, image_name VARCHAR(255) NOT NULL, image_path VARCHAR(255) NOT NULL, online TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_EAC287D7AC199498 (image_name), INDEX IDX_EAC287D7F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clairegindre_user ADD CONSTRAINT FK_65A3C91FEE45BDBF FOREIGN KEY (picture_id) REFERENCES clairegindre_picture (id)');
        $this->addSql('ALTER TABLE clairegindre_article ADD CONSTRAINT FK_818862BEF675F31B FOREIGN KEY (author_id) REFERENCES clairegindre_user (id)');
        $this->addSql('ALTER TABLE clairegindre_article ADD CONSTRAINT FK_818862BE9E45C554 FOREIGN KEY (prestation_id) REFERENCES clairegindre_benefit (id)');
        $this->addSql('ALTER TABLE clairegindre_benefit ADD CONSTRAINT FK_DF396CC7A76ED395 FOREIGN KEY (user_id) REFERENCES clairegindre_user (id)');
        $this->addSql('ALTER TABLE clairegindre_comment ADD CONSTRAINT FK_17C63EB4F675F31B FOREIGN KEY (author_id) REFERENCES clairegindre_user (id)');
        $this->addSql('ALTER TABLE clairegindre_comment ADD CONSTRAINT FK_17C63EB47294869C FOREIGN KEY (article_id) REFERENCES clairegindre_article (id)');
        $this->addSql('ALTER TABLE clairegindre_gallery ADD CONSTRAINT FK_C49914E27294869C FOREIGN KEY (article_id) REFERENCES clairegindre_article (id)');
        $this->addSql('ALTER TABLE clairegindre_gallery ADD CONSTRAINT FK_C49914E2A76ED395 FOREIGN KEY (user_id) REFERENCES clairegindre_user (id)');
        $this->addSql('ALTER TABLE clairegindre_gallery ADD CONSTRAINT FK_C49914E2B517B89 FOREIGN KEY (benefit_id) REFERENCES clairegindre_benefit (id)');
        $this->addSql('ALTER TABLE clairegindre_gallery_maker ADD CONSTRAINT FK_D42388517294869C FOREIGN KEY (article_id) REFERENCES clairegindre_article (id)');
        $this->addSql('ALTER TABLE clairegindre_mail ADD CONSTRAINT FK_B916B31EAA334807 FOREIGN KEY (answer_id) REFERENCES clairegindre_mail (id)');
        $this->addSql('ALTER TABLE clairegindre_picture ADD CONSTRAINT FK_956923515D578C78 FOREIGN KEY (gallery_maker_id) REFERENCES clairegindre_gallery_maker (id)');
        $this->addSql('ALTER TABLE clairegindre_picture ADD CONSTRAINT FK_956923514E7AF8F FOREIGN KEY (gallery_id) REFERENCES clairegindre_gallery (id)');
        $this->addSql('ALTER TABLE clairegindre_reviews ADD CONSTRAINT FK_EAC287D7F675F31B FOREIGN KEY (author_id) REFERENCES clairegindre_user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clairegindre_article DROP FOREIGN KEY FK_818862BEF675F31B');
        $this->addSql('ALTER TABLE clairegindre_benefit DROP FOREIGN KEY FK_DF396CC7A76ED395');
        $this->addSql('ALTER TABLE clairegindre_comment DROP FOREIGN KEY FK_17C63EB4F675F31B');
        $this->addSql('ALTER TABLE clairegindre_gallery DROP FOREIGN KEY FK_C49914E2A76ED395');
        $this->addSql('ALTER TABLE clairegindre_reviews DROP FOREIGN KEY FK_EAC287D7F675F31B');
        $this->addSql('ALTER TABLE clairegindre_comment DROP FOREIGN KEY FK_17C63EB47294869C');
        $this->addSql('ALTER TABLE clairegindre_gallery DROP FOREIGN KEY FK_C49914E27294869C');
        $this->addSql('ALTER TABLE clairegindre_gallery_maker DROP FOREIGN KEY FK_D42388517294869C');
        $this->addSql('ALTER TABLE clairegindre_article DROP FOREIGN KEY FK_818862BE9E45C554');
        $this->addSql('ALTER TABLE clairegindre_gallery DROP FOREIGN KEY FK_C49914E2B517B89');
        $this->addSql('ALTER TABLE clairegindre_picture DROP FOREIGN KEY FK_956923514E7AF8F');
        $this->addSql('ALTER TABLE clairegindre_picture DROP FOREIGN KEY FK_956923515D578C78');
        $this->addSql('ALTER TABLE clairegindre_mail DROP FOREIGN KEY FK_B916B31EAA334807');
        $this->addSql('ALTER TABLE clairegindre_user DROP FOREIGN KEY FK_65A3C91FEE45BDBF');
        $this->addSql('DROP TABLE clairegindre_user');
        $this->addSql('DROP TABLE clairegindre_article');
        $this->addSql('DROP TABLE clairegindre_benefit');
        $this->addSql('DROP TABLE clairegindre_comment');
        $this->addSql('DROP TABLE clairegindre_gallery');
        $this->addSql('DROP TABLE clairegindre_gallery_maker');
        $this->addSql('DROP TABLE clairegindre_mail');
        $this->addSql('DROP TABLE clairegindre_picture');
        $this->addSql('DROP TABLE clairegindre_reviews');
    }
}
