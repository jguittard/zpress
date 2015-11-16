<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151115221733 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE taxonomy (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_time DATETIME NOT NULL, updated_time DATETIME NOT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_FD12B83D989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id VARCHAR(255) NOT NULL, parent_id VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_64C19C1727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id VARCHAR(255) NOT NULL, parent_id VARCHAR(255) DEFAULT NULL, post_id VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, validated TINYINT(1) NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, website VARCHAR(255) DEFAULT NULL, created_time DATETIME NOT NULL, updated_time DATETIME NOT NULL, UNIQUE INDEX UNIQ_9474526C727ACA70 (parent_id), INDEX IDX_9474526C4B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id VARCHAR(255) NOT NULL, type_id VARCHAR(255) NOT NULL, author_id VARCHAR(255) NOT NULL, category_id VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, excerpt LONGTEXT DEFAULT NULL, content LONGTEXT DEFAULT NULL, status INT UNSIGNED NOT NULL, likes INT UNSIGNED NOT NULL, published_at DATETIME DEFAULT NULL, banner VARCHAR(255) DEFAULT NULL, created_time DATETIME NOT NULL, updated_time DATETIME NOT NULL, UNIQUE INDEX UNIQ_5A8A6C8D989D9B62 (slug), INDEX IDX_5A8A6C8DC54C8C93 (type_id), INDEX IDX_5A8A6C8DF675F31B (author_id), INDEX IDX_5A8A6C8D12469DE2 (category_id), INDEX slug_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posttype (id VARCHAR(255) NOT NULL, icon VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_post (tag_id VARCHAR(255) NOT NULL, post_id VARCHAR(255) NOT NULL, INDEX IDX_B485D33BBAD26311 (tag_id), INDEX IDX_B485D33B4B89032C (post_id), PRIMARY KEY(tag_id, post_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL UNIQUE, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, bio LONGTEXT DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, created_time DATETIME NOT NULL, updated_time DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1BF396750 FOREIGN KEY (id) REFERENCES taxonomy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C727ACA70 FOREIGN KEY (parent_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DC54C8C93 FOREIGN KEY (type_id) REFERENCES posttype (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE posttype ADD CONSTRAINT FK_98F2C3A0BF396750 FOREIGN KEY (id) REFERENCES taxonomy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B783BF396750 FOREIGN KEY (id) REFERENCES taxonomy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_post ADD CONSTRAINT FK_B485D33BBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_post ADD CONSTRAINT FK_B485D33B4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1BF396750');
        $this->addSql('ALTER TABLE posttype DROP FOREIGN KEY FK_98F2C3A0BF396750');
        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B783BF396750');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D12469DE2');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C727ACA70');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4B89032C');
        $this->addSql('ALTER TABLE tag_post DROP FOREIGN KEY FK_B485D33B4B89032C');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DC54C8C93');
        $this->addSql('ALTER TABLE tag_post DROP FOREIGN KEY FK_B485D33BBAD26311');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DF675F31B');
        $this->addSql('DROP TABLE taxonomy');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE posttype');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_post');
        $this->addSql('DROP TABLE user');
    }
}
