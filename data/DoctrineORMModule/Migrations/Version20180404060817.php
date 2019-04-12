<?php declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180404060817 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->connection->exec("INSERT INTO `user` (`email`, `password`, `firstName`, `lastName`, `patronymic`, `phone`, `phoneWork`, `phoneInternal`, `post`, `birthedAt`, `employedAt`, `photo`, `notation`, `createdAt`, `isInner`) VALUES ('storage@stagem.com.ua', '84862b7574a0bc370277c63c6d6eaacc', 'Support Stagem', 'Адмін', '', '', '', '', '', NULL, NULL, '', '', '2018-03-16 16:23:40', '1');");
        $userId = $this->connection->lastInsertId();

        #$this->abortIf(!$userId, 'Cannot insert admin user');
        $this->connection->exec("INSERT INTO `role` (`name`, `mnemo`, `resource`) VALUES ('Admin', 'admin', 'all')");
        $roleId = $this->connection->lastInsertId();

        $this->connection->insert('users_roles', [
            'userId' => $userId,
            'roleId' => $roleId,
        ]);
    }

    public function down(Schema $schema) : void
    {

    }
}
