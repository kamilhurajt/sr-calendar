<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200330062613 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Update category table and add hash';
    }

    public function up(Schema $schema) : void
    {
        $sql = 'ALTER TABLE `category` 
                    ADD COLUMN `hash` VARCHAR(255) NOT NULL,
                    ADD INDEX `hash_key` (`hash` ASC)';

        $this->addSql($sql);

    }

    public function down(Schema $schema) : void
    {
        $sql = 'ALTER TABLE `category` DROO COLUMN `hash`';

        $this->addSql($sql);
    }
}
