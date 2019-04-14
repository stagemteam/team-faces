<?php

declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190414074022 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD gender INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_statistic RENAME INDEX idx_649b469cc1f9b06d TO IDX_647BCB78C1F9B06D');
        $this->addSql('ALTER TABLE user_statistic RENAME INDEX idx_649b469c7b2cd1c4 TO IDX_647BCB787B2CD1C4');
        $this->addSql('ALTER TABLE user_statistic RENAME INDEX idx_649b469c64b64dcc TO IDX_647BCB7864B64DCC');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP gender');
        $this->addSql('ALTER TABLE user_statistic RENAME INDEX idx_647bcb7864b64dcc TO IDX_649B469C64B64DCC');
        $this->addSql('ALTER TABLE user_statistic RENAME INDEX idx_647bcb78c1f9b06d TO IDX_649B469CC1F9B06D');
        $this->addSql('ALTER TABLE user_statistic RENAME INDEX idx_647bcb787b2cd1c4 TO IDX_649B469C7B2CD1C4');
    }
}
