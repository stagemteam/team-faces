<?php

declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190413231048 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE statistic ADD userToPickId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C7B2CD1C4 FOREIGN KEY (userToPickId) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_649B469C7B2CD1C4 ON statistic (userToPickId)');
        $this->addSql('ALTER TABLE `statistic` RENAME `user_statistic`');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469C7B2CD1C4');
        $this->addSql('DROP INDEX IDX_649B469C7B2CD1C4 ON statistic');
        $this->addSql('ALTER TABLE statistic DROP userToPickId');
        $this->addSql('ALTER TABLE `user_statistic` RENAME `statistic`');
    }
}
