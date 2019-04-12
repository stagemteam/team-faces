<?php declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190412160710 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lang (id INT UNSIGNED AUTO_INCREMENT NOT NULL, mnemo VARCHAR(255) NOT NULL, locale VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, isActive INT DEFAULT 0, UNIQUE INDEX UNIQ_310984623F3BA439 (mnemo), UNIQUE INDEX UNIQ_310984624180C698 (locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE config_data (id INT UNSIGNED AUTO_INCREMENT NOT NULL, poolId INT NOT NULL, path VARCHAR(255) NOT NULL, value LONGTEXT NOT NULL, inherit INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entity (id INT UNSIGNED AUTO_INCREMENT NOT NULL, namespace VARCHAR(255) NOT NULL, mnemo VARCHAR(32) NOT NULL, hidden SMALLINT NOT NULL, moduleId INT UNSIGNED DEFAULT NULL, INDEX IDX_E284468A5ED6481 (moduleId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, mnemo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C2426285E237E06 (name), UNIQUE INDEX UNIQ_C2426283F3BA439 (mnemo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fields (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, mnemo VARCHAR(50) NOT NULL, entityId INT UNSIGNED DEFAULT NULL, INDEX IDX_7EE5E388F62829FC (entityId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fields_pages (id INT UNSIGNED AUTO_INCREMENT NOT NULL, fieldsId INT UNSIGNED NOT NULL, pagesId INT UNSIGNED NOT NULL, position INT NOT NULL, INDEX IDX_8815D603E0E49C96 (fieldsId), INDEX IDX_8815D603A895F8C2 (pagesId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pages (id INT UNSIGNED AUTO_INCREMENT NOT NULL, page VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_grid_settings (id INT UNSIGNED AUTO_INCREMENT NOT NULL, userId INT NOT NULL, gridId VARCHAR(50) NOT NULL, columns LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permission (id INT UNSIGNED AUTO_INCREMENT NOT NULL, target VARCHAR(255) NOT NULL, entityId INT UNSIGNED NOT NULL, type VARCHAR(50) NOT NULL, module VARCHAR(100) NOT NULL, parent INT NOT NULL, typeField VARCHAR(255) NOT NULL, required VARCHAR(255) NOT NULL, INDEX entityId (entityId), INDEX module (module), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permission_access (id INT UNSIGNED AUTO_INCREMENT NOT NULL, permissionId INT UNSIGNED NOT NULL, roleId VARCHAR(6) NOT NULL, access INT NOT NULL, INDEX IDX_CFB38CBF605405B0 (permissionId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permission_page_bind (id INT UNSIGNED AUTO_INCREMENT NOT NULL, permissionSettingsPagesId INT UNSIGNED NOT NULL, childrenId INT UNSIGNED NOT NULL, entityId INT UNSIGNED NOT NULL, INDEX IDX_E3FFC1E5CE09048A (permissionSettingsPagesId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permission_settings (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, mnemo VARCHAR(50) NOT NULL, entityId INT UNSIGNED DEFAULT NULL, INDEX IDX_107D7573F62829FC (entityId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permission_settings_pages (id INT UNSIGNED AUTO_INCREMENT NOT NULL, permissionSettingsId INT UNSIGNED NOT NULL, pagesId INT UNSIGNED NOT NULL, INDEX IDX_93BBC2086AD0AAF5 (permissionSettingsId), INDEX IDX_93BBC208A895F8C2 (pagesId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT UNSIGNED AUTO_INCREMENT NOT NULL, email VARCHAR(101) NOT NULL, password VARCHAR(32) NOT NULL, firstName VARCHAR(255) NOT NULL, lastName VARCHAR(255) NOT NULL, patronymic VARCHAR(255) DEFAULT NULL, phone VARCHAR(13) DEFAULT NULL, phoneWork VARCHAR(13) DEFAULT NULL, phoneInternal VARCHAR(13) DEFAULT NULL, post VARCHAR(255) DEFAULT NULL, birthedAt DATETIME DEFAULT NULL, createdAt DATETIME DEFAULT NULL, employedAt DATETIME DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, isInner INT NOT NULL, notation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_roles (userId INT UNSIGNED NOT NULL, roleId INT UNSIGNED NOT NULL, INDEX IDX_51498A8E64B64DCC (userId), INDEX IDX_51498A8EB8C2FD88 (roleId), PRIMARY KEY(userId, roleId)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, mnemo VARCHAR(32) NOT NULL, resource VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mail (id INT UNSIGNED AUTO_INCREMENT NOT NULL, action VARCHAR(32) NOT NULL, theme VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, hidden VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, info LONGTEXT NOT NULL, lastDateCron DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mail_option (id INT UNSIGNED AUTO_INCREMENT NOT NULL, period INT NOT NULL, emailTo VARCHAR(255) NOT NULL, mailId INT UNSIGNED NOT NULL, step INT NOT NULL, INDEX IDX_87BFBFDBCD7D381A (mailId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mail_option_role (id INT UNSIGNED AUTO_INCREMENT NOT NULL, roleId INT UNSIGNED NOT NULL, mailId INT UNSIGNED NOT NULL, cityCreator VARCHAR(255) NOT NULL, byBrand VARCHAR(255) NOT NULL, cityIn VARCHAR(255) NOT NULL, INDEX IDX_BB85D54CD7D381A (mailId), INDEX IDX_BB85D54B8C2FD88 (roleId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mail_role (id INT UNSIGNED AUTO_INCREMENT NOT NULL, mailId INT UNSIGNED DEFAULT NULL, roleId INT UNSIGNED DEFAULT NULL, INDEX IDX_FA121903CD7D381A (mailId), INDEX IDX_FA121903B8C2FD88 (roleId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entity ADD CONSTRAINT FK_E284468A5ED6481 FOREIGN KEY (moduleId) REFERENCES module (id)');
        $this->addSql('ALTER TABLE fields ADD CONSTRAINT FK_7EE5E388F62829FC FOREIGN KEY (entityId) REFERENCES entity (id)');
        $this->addSql('ALTER TABLE fields_pages ADD CONSTRAINT FK_8815D603E0E49C96 FOREIGN KEY (fieldsId) REFERENCES fields (id)');
        $this->addSql('ALTER TABLE fields_pages ADD CONSTRAINT FK_8815D603A895F8C2 FOREIGN KEY (pagesId) REFERENCES pages (id)');
        $this->addSql('ALTER TABLE permission_access ADD CONSTRAINT FK_CFB38CBF605405B0 FOREIGN KEY (permissionId) REFERENCES permission (id)');
        $this->addSql('ALTER TABLE permission_page_bind ADD CONSTRAINT FK_E3FFC1E5CE09048A FOREIGN KEY (permissionSettingsPagesId) REFERENCES permission_settings_pages (id)');
        $this->addSql('ALTER TABLE permission_settings ADD CONSTRAINT FK_107D7573F62829FC FOREIGN KEY (entityId) REFERENCES entity (id)');
        $this->addSql('ALTER TABLE permission_settings_pages ADD CONSTRAINT FK_93BBC2086AD0AAF5 FOREIGN KEY (permissionSettingsId) REFERENCES permission_settings (id)');
        $this->addSql('ALTER TABLE permission_settings_pages ADD CONSTRAINT FK_93BBC208A895F8C2 FOREIGN KEY (pagesId) REFERENCES pages (id)');
        $this->addSql('ALTER TABLE users_roles ADD CONSTRAINT FK_51498A8E64B64DCC FOREIGN KEY (userId) REFERENCES user (id)');
        $this->addSql('ALTER TABLE users_roles ADD CONSTRAINT FK_51498A8EB8C2FD88 FOREIGN KEY (roleId) REFERENCES role (id)');
        $this->addSql('ALTER TABLE mail_option ADD CONSTRAINT FK_87BFBFDBCD7D381A FOREIGN KEY (mailId) REFERENCES mail (id)');
        $this->addSql('ALTER TABLE mail_option_role ADD CONSTRAINT FK_BB85D54CD7D381A FOREIGN KEY (mailId) REFERENCES mail (id)');
        $this->addSql('ALTER TABLE mail_option_role ADD CONSTRAINT FK_BB85D54B8C2FD88 FOREIGN KEY (roleId) REFERENCES role (id)');
        $this->addSql('ALTER TABLE mail_role ADD CONSTRAINT FK_FA121903CD7D381A FOREIGN KEY (mailId) REFERENCES mail (id)');
        $this->addSql('ALTER TABLE mail_role ADD CONSTRAINT FK_FA121903B8C2FD88 FOREIGN KEY (roleId) REFERENCES role (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fields DROP FOREIGN KEY FK_7EE5E388F62829FC');
        $this->addSql('ALTER TABLE permission_settings DROP FOREIGN KEY FK_107D7573F62829FC');
        $this->addSql('ALTER TABLE entity DROP FOREIGN KEY FK_E284468A5ED6481');
        $this->addSql('ALTER TABLE fields_pages DROP FOREIGN KEY FK_8815D603E0E49C96');
        $this->addSql('ALTER TABLE fields_pages DROP FOREIGN KEY FK_8815D603A895F8C2');
        $this->addSql('ALTER TABLE permission_settings_pages DROP FOREIGN KEY FK_93BBC208A895F8C2');
        $this->addSql('ALTER TABLE permission_access DROP FOREIGN KEY FK_CFB38CBF605405B0');
        $this->addSql('ALTER TABLE permission_settings_pages DROP FOREIGN KEY FK_93BBC2086AD0AAF5');
        $this->addSql('ALTER TABLE permission_page_bind DROP FOREIGN KEY FK_E3FFC1E5CE09048A');
        $this->addSql('ALTER TABLE users_roles DROP FOREIGN KEY FK_51498A8E64B64DCC');
        $this->addSql('ALTER TABLE users_roles DROP FOREIGN KEY FK_51498A8EB8C2FD88');
        $this->addSql('ALTER TABLE mail_option_role DROP FOREIGN KEY FK_BB85D54B8C2FD88');
        $this->addSql('ALTER TABLE mail_role DROP FOREIGN KEY FK_FA121903B8C2FD88');
        $this->addSql('ALTER TABLE mail_option DROP FOREIGN KEY FK_87BFBFDBCD7D381A');
        $this->addSql('ALTER TABLE mail_option_role DROP FOREIGN KEY FK_BB85D54CD7D381A');
        $this->addSql('ALTER TABLE mail_role DROP FOREIGN KEY FK_FA121903CD7D381A');
        $this->addSql('DROP TABLE lang');
        $this->addSql('DROP TABLE config_data');
        $this->addSql('DROP TABLE entity');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE fields');
        $this->addSql('DROP TABLE fields_pages');
        $this->addSql('DROP TABLE pages');
        $this->addSql('DROP TABLE user_grid_settings');
        $this->addSql('DROP TABLE permission');
        $this->addSql('DROP TABLE permission_access');
        $this->addSql('DROP TABLE permission_page_bind');
        $this->addSql('DROP TABLE permission_settings');
        $this->addSql('DROP TABLE permission_settings_pages');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE users_roles');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE mail');
        $this->addSql('DROP TABLE mail_option');
        $this->addSql('DROP TABLE mail_option_role');
        $this->addSql('DROP TABLE mail_role');
    }
}
