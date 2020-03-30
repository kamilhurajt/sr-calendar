<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200323104711 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Update events table and add city column';
    }

    public function up(Schema $schema) : void
    {
        $sql = 'ALTER TABLE `event` ADD COLUMN `city` VARCHAR(255) NOT NULL';

        $this->addSql($sql);

    }

    public function down(Schema $schema) : void
    {
        $sql = 'ALTER TABLE `event` DROP COLUMN IF EXISTS `city`';

        $this->addSql($sql);
    }
}
