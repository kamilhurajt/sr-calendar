<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322193613 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create category table';
    }

    public function up(Schema $schema) : void
    {
        $sql = 'CREATE TABLE IF NOT EXISTS `category` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR(255) NOT NULL,
                  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
                  PRIMARY KEY (`id`))
                ENGINE = InnoDB';

        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        $sql = 'DROP TABLE IF EXISTS `category`';

        $this->addSql($sql);
    }
}
