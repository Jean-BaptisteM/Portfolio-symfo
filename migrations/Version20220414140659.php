<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220414140659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cms (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cms_user (cms_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_4A057B34BE8A7CFB (cms_id), INDEX IDX_4A057B34A76ED395 (user_id), PRIMARY KEY(cms_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `database` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE database_user (database_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FFEE9405F0AA09DB (database_id), INDEX IDX_FFEE9405A76ED395 (user_id), PRIMARY KEY(database_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE framework (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE framework_user (framework_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_F22C332437AECF72 (framework_id), INDEX IDX_F22C3324A76ED395 (user_id), PRIMARY KEY(framework_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language_user (language_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_BF9A3C0582F1BAF4 (language_id), INDEX IDX_BF9A3C05A76ED395 (user_id), PRIMARY KEY(language_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operating_system (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operating_system_user (operating_system_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7EE9B727A391D4AD (operating_system_id), INDEX IDX_7EE9B727A76ED395 (user_id), PRIMARY KEY(operating_system_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, summary LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, github VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_2FB3D0EEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_category (project_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_3B02921A166D1F9C (project_id), INDEX IDX_3B02921A12469DE2 (category_id), PRIMARY KEY(project_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE software (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE software_user (software_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A896DCB5D7452741 (software_id), INDEX IDX_A896DCB5A76ED395 (user_id), PRIMARY KEY(software_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(20) NOT NULL, lastname VARCHAR(10) NOT NULL, profil VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, github VARCHAR(255) NOT NULL, linkedin VARCHAR(255) NOT NULL, twitter VARCHAR(255) DEFAULT NULL, presentation LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, age DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE versionning (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE versionning_user (versionning_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_27DAB575F9B36338 (versionning_id), INDEX IDX_27DAB575A76ED395 (user_id), PRIMARY KEY(versionning_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cms_user ADD CONSTRAINT FK_4A057B34BE8A7CFB FOREIGN KEY (cms_id) REFERENCES cms (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cms_user ADD CONSTRAINT FK_4A057B34A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE database_user ADD CONSTRAINT FK_FFEE9405F0AA09DB FOREIGN KEY (database_id) REFERENCES `database` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE database_user ADD CONSTRAINT FK_FFEE9405A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE framework_user ADD CONSTRAINT FK_F22C332437AECF72 FOREIGN KEY (framework_id) REFERENCES framework (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE framework_user ADD CONSTRAINT FK_F22C3324A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE language_user ADD CONSTRAINT FK_BF9A3C0582F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE language_user ADD CONSTRAINT FK_BF9A3C05A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE operating_system_user ADD CONSTRAINT FK_7EE9B727A391D4AD FOREIGN KEY (operating_system_id) REFERENCES operating_system (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE operating_system_user ADD CONSTRAINT FK_7EE9B727A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE project_category ADD CONSTRAINT FK_3B02921A166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_category ADD CONSTRAINT FK_3B02921A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE software_user ADD CONSTRAINT FK_A896DCB5D7452741 FOREIGN KEY (software_id) REFERENCES software (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE software_user ADD CONSTRAINT FK_A896DCB5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE versionning_user ADD CONSTRAINT FK_27DAB575F9B36338 FOREIGN KEY (versionning_id) REFERENCES versionning (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE versionning_user ADD CONSTRAINT FK_27DAB575A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_category DROP FOREIGN KEY FK_3B02921A12469DE2');
        $this->addSql('ALTER TABLE cms_user DROP FOREIGN KEY FK_4A057B34BE8A7CFB');
        $this->addSql('ALTER TABLE database_user DROP FOREIGN KEY FK_FFEE9405F0AA09DB');
        $this->addSql('ALTER TABLE framework_user DROP FOREIGN KEY FK_F22C332437AECF72');
        $this->addSql('ALTER TABLE language_user DROP FOREIGN KEY FK_BF9A3C0582F1BAF4');
        $this->addSql('ALTER TABLE operating_system_user DROP FOREIGN KEY FK_7EE9B727A391D4AD');
        $this->addSql('ALTER TABLE project_category DROP FOREIGN KEY FK_3B02921A166D1F9C');
        $this->addSql('ALTER TABLE software_user DROP FOREIGN KEY FK_A896DCB5D7452741');
        $this->addSql('ALTER TABLE cms_user DROP FOREIGN KEY FK_4A057B34A76ED395');
        $this->addSql('ALTER TABLE database_user DROP FOREIGN KEY FK_FFEE9405A76ED395');
        $this->addSql('ALTER TABLE framework_user DROP FOREIGN KEY FK_F22C3324A76ED395');
        $this->addSql('ALTER TABLE language_user DROP FOREIGN KEY FK_BF9A3C05A76ED395');
        $this->addSql('ALTER TABLE operating_system_user DROP FOREIGN KEY FK_7EE9B727A76ED395');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEA76ED395');
        $this->addSql('ALTER TABLE software_user DROP FOREIGN KEY FK_A896DCB5A76ED395');
        $this->addSql('ALTER TABLE versionning_user DROP FOREIGN KEY FK_27DAB575A76ED395');
        $this->addSql('ALTER TABLE versionning_user DROP FOREIGN KEY FK_27DAB575F9B36338');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE cms');
        $this->addSql('DROP TABLE cms_user');
        $this->addSql('DROP TABLE `database`');
        $this->addSql('DROP TABLE database_user');
        $this->addSql('DROP TABLE framework');
        $this->addSql('DROP TABLE framework_user');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE language_user');
        $this->addSql('DROP TABLE operating_system');
        $this->addSql('DROP TABLE operating_system_user');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_category');
        $this->addSql('DROP TABLE software');
        $this->addSql('DROP TABLE software_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE versionning');
        $this->addSql('DROP TABLE versionning_user');
    }
}
